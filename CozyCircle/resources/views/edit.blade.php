@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">

  <div class="bg-white border-2 border-black rounded-2xl p-8 shadow-[6px_6px_0px_rgba(0,0,0,1)]">
    <h1 class="text-2xl font-black mb-6">Edit Profile</h1>

    @if(session('success'))
      <div class="mb-4 p-3 bg-green-100 border-2 border-black rounded-xl font-bold">
        {{ session('success') }}
      </div>
    @endif

    <form method="POST" action="{{ route('profile.update') }}" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label class="block font-bold mb-1">Name</label>
        <input name="name" value="{{ old('name', $user->name) }}"
          class="w-full border-2 border-black rounded-xl px-4 py-2" />
        @error('name') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block font-bold mb-1">Email</label>
        <input name="email" value="{{ old('email', $user->email) }}"
          class="w-full border-2 border-black rounded-xl px-4 py-2" />
        @error('email') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block font-bold mb-1">Bio</label>
        <textarea name="bio" rows="3"
          class="w-full border-2 border-black rounded-xl px-4 py-2">{{ old('bio', $user->bio) }}</textarea>
        @error('bio') <p class="text-red-600 text-sm mt-1">{{ $message }}</p> @enderror
      </div>

      <div>
        <label class="block font-bold mb-1">Hobbies (comma separated)</label>
        <input name="hobbies"
          value="{{ old('hobbies', is_array($user->hobbies) ? implode(', ', $user->hobbies) : '') }}"
          class="w-full border-2 border-black rounded-xl px-4 py-2" />
      </div>

      <div class="flex gap-3 pt-2">
        <button class="bg-black text-white px-6 py-2 rounded-full font-bold border-2 border-black hover:bg-white hover:text-black transition">
          Save
        </button>
        <a href="{{ route('profile.show') }}" class="px-6 py-2 rounded-full font-bold border-2 border-black hover:bg-gray-100">
          Cancel
        </a>
      </div>
    </form>
  </div>

</div>
@endsection