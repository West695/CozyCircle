@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border-2 border-black rounded-2xl p-8 shadow-[6px_6px_0px_rgba(0,0,0,1)]">
        <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

        <form method="POST" action="#">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-bold mb-1" for="name">Name</label>
                <input id="name" name="name" value="{{ Auth::user()->name ?? '' }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black outline-none" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1" for="email">Email</label>
                <input id="email" name="email" value="{{ Auth::user()->email ?? '' }}" type="email" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black outline-none" />
            </div>

            <div class="flex items-center gap-4">
                <button class="bg-black text-white font-bold px-6 py-2 rounded-full border-2 border-transparent hover:bg-white hover:text-black hover:border-black transition">Save</button>
                <a href="{{ route('profile') }}" class="underline font-bold text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
