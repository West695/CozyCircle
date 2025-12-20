<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Http\Controllers\ProfileController;


Route::get('/', function () {
    $featuredPosts = Post::with(['user', 'category'])->latest()->take(3)->get();
    $categories = Category::all();
    return view('hero', compact('featuredPosts', 'categories'));
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended(route('profile'));
    }

    return back()->withErrors([
        'email' => 'The provided credentials do not match our records.',
    ])->onlyInput('email');
})->name('login.attempt');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/forum', function () {
    $categoryId = request()->query('category');
    $query = Post::with(['user', 'category', 'comments.user'])->latest();
    if ($categoryId) {
        $query->where('category_id', $categoryId);
    }
    $posts = $query->get();
    $categories = Category::all();
    $selectedCategory = $categoryId ? Category::find($categoryId) : null;
    return view('forum', compact('posts', 'categories', 'selectedCategory'));
})->name('forum');

// Store a new post (discussion)
Route::post('/posts', function (Request $request) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    $data = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'content' => ['nullable', 'string'],
        'category_id' => ['nullable', 'exists:categories,id'],
    ]);

    // Ensure we have a valid category id. If none provided, fall back to the "General" category
    if (empty($data['category_id'])) {
        $category = Category::where('slug', 'general')->first();
        if (!$category) {
            $category = Category::create(['name' => 'General', 'slug' => 'general']);
        }
        $categoryId = $category->id;
    } else {
        $categoryId = $data['category_id'];
    }

    $post = Post::create([
        'title' => $data['title'],
        'content' => $data['content'] ?? null,
        'category_id' => $categoryId,
        'user_id' => Auth::id(),
    ]);

    return redirect()->route('forum')->with('success', 'Discussion created.');
})->name('posts.store');

// Store a comment for a post
Route::post('/posts/{post}/comments', function (Request $request, Post $post) {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
    $data = $request->validate([
        'content' => ['required', 'string', 'max:2000'],
    ]);

    $comment = Comment::create([
        'post_id' => $post->id,
        'user_id' => Auth::id(),
        'content' => $data['content'],
    ]);

    if ($request->wantsJson() || $request->ajax()) {
        $comment->load('user');
        return response()->json([
            'id' => $comment->id,
            'content' => $comment->content,
            'created_at' => $comment->created_at->diffForHumans(),
            'user' => ['name' => $comment->user->name ?? 'Guest']
        ], 201);
    }
    return back()->with('success', 'Comment posted.');
})->name('posts.comments');
// JSON endpoint for fetching a single post with comments
Route::get('/posts/{post}/json', function (Post $post) {
    $post->load(['user', 'category', 'comments.user']);
    $postData = [
        'id' => $post->id,
        'title' => $post->title,
        'content' => $post->content,
        'category' => $post->category ? ['id' => $post->category->id, 'name' => $post->category->name] : null,
        'user' => ['name' => $post->user->name ?? 'Guest'],
        'created_at' => $post->created_at->diffForHumans(),
        'comments' => $post->comments->map(function ($c) {
            return [
                'id' => $c->id,
                'content' => $c->content,
                'created_at' => $c->created_at->diffForHumans(),
                'user' => ['name' => $c->user->name ?? 'Guest']
            ];
        })->values(),
    ];

    return response()->json($postData);
})->name('posts.json');
// Delete a post (admin only)
Route::delete('/posts/{post}', function (Post $post) {
    if (!Auth::check() || !Auth::user()->is_admin) {
        abort(403);
    }

    $post->delete();
    return redirect()->route('forum')->with('success', 'Discussion deleted.');
})->name('posts.destroy');

Route::get('/community', function () {
    $featuredPosts = Post::with(['user', 'category'])->latest()->take(3)->get();
    $categories = Category::all();
    $totalMembers = User::count();
    $totalPosts = Post::count();
    $totalCategories = Category::count();
    $activeMembers = User::whereHas('posts', function($q) {
        $q->where('created_at', '>=', now()->subDays(7));
    })->orWhereHas('comments', function($q) {
        $q->where('created_at', '>=', now()->subDays(7));
    })->limit(5)->get();
    return view('community', compact('featuredPosts', 'categories', 'totalMembers', 'totalPosts', 'totalCategories', 'activeMembers'));
})->name('community');

Route::get('/register', function () {
    return view('signup');
})->name('register');

Route::post('/register', function (Request $request) {
    $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255', 'unique:users,email'],
        'password' => ['required', 'confirmed', 'min:8'],
    ]);

    $user = User::create([
        'username' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);
    return redirect()->route('profile');
})->name('register.submit');

Route::get('/password/reset', function () {
    return view('password.request');
})->name('password.request');


Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});