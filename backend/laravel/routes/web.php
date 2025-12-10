<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('hero');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/forum', function () {
    return view('forum');
})->name('forum');
