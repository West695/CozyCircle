<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    return view('forum');
})->name('forum');

Route::get('/community', function () {
    return view('community');
})->name('community');

Route::get('/register', function () {
    return view('register');
})->name('register');

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
