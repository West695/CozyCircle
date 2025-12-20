<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        // Recent Activity = forum posts by this user (latest first)
        $posts = Post::with(['category'])
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        return view('profile', compact('user', 'posts'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255', Rule::unique('users')->ignore($user->id)],
            'bio' => ['nullable','string','max:500'],
            'hobbies' => ['nullable','array'],
            'hobbies.*' => ['string'],
        ]);

        // Store name as `username` column
        $user->username = $data['name'];
        $user->email = $data['email'];
        $user->bio = $data['bio'] ?? null;

        // Hobbies now come as an array of options from the form
        $user->hobbies = isset($data['hobbies']) ? array_values(array_filter($data['hobbies'])) : null;

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated!');
    }
}