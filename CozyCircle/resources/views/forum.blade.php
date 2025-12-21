@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-12">
    <div class="mb-6 flex items-start justify-between gap-4">
        <div>
            <h1 class="text-4xl font-bold text-black mb-2">Community Forum</h1>
            <p class="text-lg text-black mb-2">Join discussions, ask questions, and connect with other members</p>
        </div>

        <div class="flex items-center gap-3">
            @auth
                <button onclick="openModal('newPostModal')" class="px-5 py-2 rounded-full bg-jive-purple text-white font-bold border-2 border-black shadow-[4px_4px_0_rgba(0,0,0,1)] hover:scale-105 transition">Start a Discussion</button>
            @else
                <button onclick="openModal('loginPromptModal')" class="px-5 py-2 rounded-full bg-gray-200 text-gray-700 font-bold border-2 border-black shadow-[2px_2px_0_rgba(0,0,0,0.7)] hover:scale-105 transition">Start a Discussion</button>
            @endauth
        </div>
    </div>
    @if($selectedCategory ?? false)
        <div class="mb-4 p-3 bg-white border-2 border-black rounded-2xl">
            <strong>Filtering:</strong> {{ $selectedCategory->name }}
            <a href="{{ route('forum') }}" class="ml-4 underline">Clear filter</a>
        </div>
    @endif
    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    <div class="grid lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2">
            <div class="space-y-4">
                @forelse($posts as $post)
                <article data-post-id="{{ $post->id }}" class="post-card post-clickable bg-white border-2 border-black rounded-2xl p-6 shadow-[6px_6px_0_rgba(0,0,0,1)] cursor-pointer">
                    <div class="flex items-start justify-between mb-2">
                        <div class="flex-1">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="text-sm px-2 py-1 rounded-full bg-white border-2 border-black text-sm font-semibold">{{ $post->category->name ?? 'General' }}</span>
                                <h3 class="text-xl font-bold mt-1">{{ $post->title ?? 'Untitled' }}</h3>
                            </div>
                            <p class="text-gray-700">{{ Str::limit($post->content, 280) }}</p>
                        </div>
                        <div class="text-right ml-4">
                            <div class="text-sm text-gray-600">By @if($post->user)<a href="#" class="user-link font-semibold" data-user-id="{{ $post->user->id }}">{{ $post->user->name }}</a>@else Guest @endif</div>
                            <div class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</div>
                        </div>
                        <div class="ml-4 flex items-start gap-2">
                            @if(auth()->check() && auth()->user()->is_admin)
                                <form method="POST" action="{{ route('posts.destroy', $post) }}" onsubmit="return confirm('Delete this discussion?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-xs px-2 py-1 bg-red-100 text-red-700 border border-red-200 rounded">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    <div class="mt-4 border-t border-black/10 pt-4 space-y-3">
                        @forelse($post->comments as $comment)
                            <div class="bg-gray-50 border border-gray-200 rounded-lg p-3">
                                <div class="text-sm text-gray-700">@if($comment->user)<a href="#" class="user-link font-semibold" data-user-id="{{ $comment->user->id }}">{{ $comment->user->name }}</a>@else Guest @endif <span class="text-xs text-gray-500">• {{ $comment->created_at->diffForHumans() }}</span></div>
                                <div class="mt-1 text-gray-600">{{ $comment->content }}</div>
                            </div>
                        @empty
                            <div class="text-gray-500 text-sm">No comments yet — be first to comment.</div>
                        @endforelse
                    </div>

                        <div class="mt-4">
                        @auth
                        <form method="POST" action="{{ route('posts.comments', $post) }}">
                            @csrf
                            <div class="flex items-start gap-3">
                                <textarea name="content" required rows="2" class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none" placeholder="Add a comment..."></textarea>
                                <div>
                                    <button type="submit" class="px-4 py-2 rounded-full bg-jive-purple text-white border-2 border-black font-semibold shadow-[3px_3px_0_rgba(0,0,0,1)]">Comment</button>
                                </div>
                            </div>
                        </form>
                        @else
                            <div class="text-sm text-gray-500">Please <a href="{{ route('login') }}" class="underline font-semibold">sign in</a> to comment.</div>
                        @endauth
                    </div>
                </article>
                @empty
                    <div class="text-gray-500">No discussions yet.</div>
                @endforelse
            </div>
        </div>

        <aside class="space-y-4">
            <div class="bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0_rgba(0,0,0,1)]">
                <h3 class="text-lg font-bold mb-2">Categories</h3>
                <ul class="space-y-2">
                    @forelse($categories as $category)
                        <li><a href="#" class="flex items-center gap-3"><span class="px-2 py-1 rounded-full bg-white border-2 border-black">{{ $category->icon ?? '📁' }}</span>{{ $category->name }}</a></li>
                    @empty
                        <li>No categories yet.</li>
                    @endforelse
                </ul>
            </div>

            <div class="bg-white border-2 border-black rounded-2xl p-4 shadow-[6px_6px_0_rgba(0,0,0,1)]">
                <h3 class="text-lg font-bold mb-2">Active Members</h3>
                @php
                    $activeMembers = \App\Models\User::whereHas('posts', function($q) {
                        $q->where('created_at', '>=', now()->subDays(7));
                    })->orWhereHas('comments', function($q) {
                        $q->where('created_at', '>=', now()->subDays(7));
                    })->limit(5)->get();
                @endphp
                @if($activeMembers->count() > 0)
                    <div class="space-y-2">
                        <p class="text-sm text-gray-500 mb-3">{{ $activeMembers->count() }} member{{ $activeMembers->count() !== 1 ? 's' : '' }} active this week</p>
                        @foreach($activeMembers as $member)
                            <a href="#" class="user-link flex items-center gap-2 p-2 rounded-lg bg-gray-50 border border-gray-200" data-user-id="{{ $member->id }}">
                                <img src="https://api.dicebear.com/7.x/avataaars/svg?seed={{ $member->name }}" alt="avatar" class="w-8 h-8 rounded-full">
                                <div class="flex-1">
                                    <p class="text-sm font-semibold">{{ $member->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $member->posts->count() + $member->comments->count() }} contribution{{ ($member->posts->count() + $member->comments->count()) !== 1 ? 's' : '' }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500">No active members yet.</p>
                @endif
            </div>
        </aside>
    </div>

    <!-- New Post Modal (form) -->
    <div id="newPostModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full">
            <form method="POST" action="{{ route('posts.store') }}" class="p-6">
                @csrf
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Start a Discussion</h2>
                    <button type="button" onclick="closeModal('newPostModal')" class="text-gray-500">Close</button>
                </div>
                <div class="mb-3">
                    @if(isset($errors) && $errors->any())
                        <div class="mb-3 text-sm text-red-600">
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <label class="block text-sm font-medium mb-2">Title</label>
                    <input type="text" name="title" required value="{{ old('title') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="What's the discussion about?">
                </div>
                <div class="mb-3">
                    <label class="block text-sm font-medium mb-2">Category</label>
                    <select name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id') ? old('category_id') == $category->id : $category->slug == 'general') ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="content" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg" placeholder="Add more details...">{{ old('content') }}</textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" class="px-4 py-2 rounded-lg border border-black" onclick="closeModal('newPostModal')">Cancel</button>
                    <button type="submit" class="px-4 py-2 rounded-lg bg-jive-purple text-white border-2 border-black font-bold">Post Discussion</button>
                </div>
            </form>
        </div>
    </div>
</div>
    <!-- Login Prompt Modal for guests -->
    <div id="loginPromptModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 text-center">
            <h3 class="text-xl font-bold mb-2">Sign in to start a discussion</h3>
            <p class="text-sm text-gray-600 mb-4">You need an account to post in the forum. Sign in or create an account to join the conversation.</p>
            <div class="flex justify-center gap-3">
                <a href="{{ route('login') }}" class="px-4 py-2 rounded-md bg-jive-purple text-white font-semibold border-2 border-black">Sign In</a>
                <a href="{{ route('signup') }}" class="px-4 py-2 rounded-md border border-black">Create Account</a>
            </div>
            <div class="mt-4">
                <button onclick="closeModal('loginPromptModal')" class="text-sm text-gray-500">Cancel</button>
            </div>
        </div>
    </div>
@endsection

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        });
    </script>
    @if(isset($errors) && $errors->any())
        <script>openModal('newPostModal');</script>
    @endif

    @if(request()->query('compose'))
        <script>openModal('newPostModal');</script>
    @endif


</body>
</html>