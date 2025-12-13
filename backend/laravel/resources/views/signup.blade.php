@extends('layouts.layout')

@section('content')
    
    <h2 class="text-2xl font-bold mb-6 text-center">Join the Jungle</h2>

    <form method="POST" action="{{ route('register.submit') }}">
        @csrf

        <div class="mb-4">
            <label class="block font-bold text-sm mb-1" for="name">Full Name</label>
            <input id="name" 
                   type="text" 
                   name="name" 
                   value="{{ old('name') }}"
                   class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black focus:ring-0 outline-none transition-colors"
                   placeholder="Akansha Sharma" 
                   required autofocus>
            @error('name')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold text-sm mb-1" for="email">Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="{{ old('email') }}"
                   class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black focus:ring-0 outline-none transition-colors"
                   placeholder="you@jivejungle.com"
                   required>
            @error('email')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-4">
            <label class="block font-bold text-sm mb-1" for="password">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black focus:ring-0 outline-none transition-colors"
                   required>
            @error('password')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label class="block font-bold text-sm mb-1" for="password_confirmation">Confirm Password</label>
            <input id="password_confirmation" 
                   type="password" 
                   name="password_confirmation" 
                   class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black focus:ring-0 outline-none transition-colors"
                   required>
        </div>

        <button type="submit" class="w-full bg-jive-yellow text-black border-2 border-black font-bold py-3 rounded-xl hover:brightness-95 transition-transform active:scale-95 shadow-[4px_4px_0px_rgba(0,0,0,1)]">
            Create Account
        </button>
    </form>

    <div class="mt-6 text-center text-sm">
        Already have an account? 
        <a href="{{ route('login') }}" class="font-bold underline hover:text-purple-700">
            Log In
        </a>
    </div>

@endsection