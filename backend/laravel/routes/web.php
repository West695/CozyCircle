<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;

Route::get('/', function () {
    return view('hero');
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
    $posts = Post::with(['user', 'category', 'comments.user'])->latest()->get();
    $categories = Category::all();
    return view('forum', compact('posts', 'categories'));
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

    $post = Post::create([
        'title' => $data['title'],
        'content' => $data['content'] ?? null,
        'category_id' => $data['category_id'] ?? null,
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

    Comment::create([
        'post_id' => $post->id,
        'user_id' => Auth::id(),
        'content' => $data['content'],
    ]);

    return back()->with('success', 'Comment posted.');
})->name('posts.comments');

Route::get('/community', function () {
    return view('community');
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

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/profile/edit', function () {
    return view('profile.edit');
})->name('profile.edit');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout');
