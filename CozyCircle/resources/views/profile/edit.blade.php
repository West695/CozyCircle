@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white border-2 border-black rounded-2xl p-8 shadow-[6px_6px_0px_rgba(0,0,0,1)]">
        <h1 class="text-2xl font-bold mb-4">Edit Profile</h1>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1" for="name">Name</label>
                <input id="name" name="name" value="{{ Auth::user()->name ?? '' }}" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black outline-none" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1" for="email">Email</label>
                <input id="email" name="email" value="{{ Auth::user()->email ?? '' }}" type="email" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black outline-none" />
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1" for="bio">Bio</label>
                <textarea id="bio" name="bio" rows="3" class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black outline-none">{{ Auth::user()->bio ?? '' }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-bold mb-1">Hobbies</label>
                <div class="flex flex-wrap gap-2">
                    @php
                        $options = [
                            ['label' => 'Gaming', 'emoji' => '🎮'],
                            ['label' => 'Music', 'emoji' => '🎵'],
                            ['label' => 'Cooking', 'emoji' => '🍳'],
                            ['label' => 'Reading', 'emoji' => '📚'],
                            ['label' => 'Sports', 'emoji' => '🏀'],
                            ['label' => 'Painting', 'emoji' => '🎨'],
                        ];
                        $userHobbies = is_array(Auth::user()->hobbies) ? Auth::user()->hobbies : (Auth::user()->hobbies ? (array)Auth::user()->hobbies : []);
                    @endphp
                    @foreach($options as $opt)
                        <label class="inline-flex items-center gap-2 px-3 py-1 bg-white border border-black rounded-lg text-xs font-bold">
                            <input type="checkbox" name="hobbies[]" value="{{ $opt['label'] }}" class="form-checkbox" {{ in_array($opt['label'], $userHobbies) ? 'checked' : '' }}>
                            <span class="text-sm">{{ $opt['emoji'] }} {{ $opt['label'] }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="bg-black text-white font-bold px-6 py-2 rounded-full border-2 border-transparent hover:bg-white hover:text-black hover:border-black transition">Save</button>
                <a href="{{ route('profile') }}" class="underline font-bold text-sm">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
