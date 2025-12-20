@extends('layouts.app')

@section('content')

    <div class="max-w-4xl mx-auto space-y-8">

        <div class="bg-white border-2 border-black rounded-2xl p-8 shadow-[6px_6px_0px_rgba(0,0,0,1)] flex flex-col md:flex-row items-center gap-6 relative overflow-hidden">
            <div class="absolute -left-10 -top-10 w-40 h-40 bg-jive-yellow rounded-full border-2 border-black z-0"></div>

            <div class="relative z-10">
                <div class="w-32 h-32 rounded-full border-2 border-black overflow-hidden bg-gray-100 flex items-center justify-center">
                    <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ Auth::user()->name ?? 'User' }}" 
                         alt="Avatar" 
                         class="w-full h-full object-cover">
                </div>
            </div>

            <div class="flex-1 text-center md:text-left z-10">
                <h1 class="text-3xl font-black tracking-tight">{{ $user->name ?? 'User' }}</h1>
                <p class="text-purple-700 font-bold mb-2">{{ $user->email ?? '' }}</p>
                <p class="text-gray-600 text-sm max-w-md mx-auto md:mx-0">
                    {{ $user->bio ?? 'Passionate about community building and clean design.' }}
                </p>
            </div>

            <div class="z-10">
                <a href="{{ route('profile.edit') }}" class="inline-block bg-black text-white px-6 py-2 rounded-full font-bold border-2 border-transparent hover:bg-white hover:text-black hover:border-black transition-colors shadow-md">
                    Edit Profile
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <div class="md:col-span-1 bg-white/80 backdrop-blur-sm border-2 border-black rounded-2xl p-6 shadow-[4px_4px_0px_rgba(0,0,0,0.5)]">
                <h3 class="text-xl font-bold mb-4 flex items-center gap-2">
                    <span>🎨</span> Hobbies
                </h3>
                <div class="flex flex-wrap gap-2">
                    @php
                        $emojiMap = [
                            'Photography' => '📸',
                            'Gaming' => '🎮',
                            'Traveling' => '✈️',
                            'Music' => '🎵',
                            'Cooking' => '🍳',
                            'Reading' => '📚',
                            'Sports' => '🏀',
                            'Painting' => '🎨',
                        ];
                        $hobbies = is_array($user->hobbies) ? $user->hobbies : ($user->hobbies ? (array)$user->hobbies : []);
                    @endphp
                    @if(count($hobbies) === 0)
                        <span class="px-3 py-1 bg-jive-yellow border border-black rounded-lg text-xs font-bold shadow-[2px_2px_0px_rgba(0,0,0,1)]">No hobbies set</span>
                    @else
                        @foreach($hobbies as $hobby)
                            <span class="px-3 py-1 bg-white border border-black rounded-lg text-xs font-bold shadow-[2px_2px_0px_rgba(0,0,0,1)]">{{ $emojiMap[$hobby] ?? '' }} {{ $hobby }}</span>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="md:col-span-2 bg-white border-2 border-black rounded-2xl p-6 shadow-[4px_4px_0px_rgba(0,0,0,0.5)]">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-bold flex items-center gap-2">
                        <span>📝</span> Recent Activity
                    </h3>
                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Last Posted</span>
                </div>

                @if($posts->count() > 0)
                    @php $post = $posts->first(); @endphp
                    <div class="group border-2 border-gray-200 hover:border-black rounded-xl p-4 transition-colors cursor-pointer bg-gray-50">
                        <div class="flex justify-between items-start mb-2">
                            <div>
                                <span class="bg-purple-100 text-purple-700 text-[10px] font-bold px-2 py-1 rounded uppercase tracking-wide">{{ $post->category->name ?? 'Discussion' }}</span>
                                <h4 class="text-lg font-bold mt-1 group-hover:text-purple-700 transition-colors">
                                    {{ $post->title }}
                                </h4>
                            </div>
                            <span class="text-xs text-gray-400 font-medium">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ $post->content ?? 'No description provided.' }}
                        </p>

                        <div class="flex items-center gap-4 text-xs font-bold text-gray-500">
                            <span class="flex items-center gap-1 hover:text-black">
                                💬 {{ $post->comments->count() }} Comments
                            </span>
                        </div>
                    </div>
                @else
                    <div class="text-center text-gray-500 py-8">
                        <p>No posts yet. Start a discussion in the forum!</p>
                    </div>
                @endif

                <div class="mt-4 text-right">
                    <a href="#" class="text-sm font-bold underline decoration-jive-yellow decoration-4 underline-offset-2 hover:text-purple-700">
                        View All Posts &rarr;
                    </a>
                </div>
            </div>
        </div>

    </div>

@endsection