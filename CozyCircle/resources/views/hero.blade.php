@extends('layouts.app')

@section('content')
<div class="relative w-full overflow-hidden">
        <main class="relative w-full max-w-5xl mx-auto flex items-center justify-center py-20 min-h-[65vh] sm:min-h-[70vh] md:min-h-[75vh]">
        <!-- Orbiting icons container -->
        @php
            $icons = [
                ['emoji' => '⚽', 'r' => '260px', 'dur' => '22s'],
                ['emoji' => '🎮', 'r' => '220px', 'dur' => '18s'],
                ['emoji' => '🎸', 'r' => '300px', 'dur' => '26s'],
                ['emoji' => '🎓', 'r' => '340px', 'dur' => '28s'],
                ['emoji' => '🏕️', 'r' => '180px', 'dur' => '16s'],
                ['emoji' => '💼', 'r' => '200px', 'dur' => '14s'],
                ['emoji' => '❤️', 'r' => '320px', 'dur' => '20s'],
            ];
        @endphp

        @foreach ($icons as $icon)
            <div class="icon-wrapper" style="--dur: {{ $icon['dur'] }}">
                <div class="icon" style="--r: {{ $icon['r'] }}">
                    <div class="icon-inner">{{ $icon['emoji'] }}</div>
                </div>
            </div>
        @endforeach

        <!-- Center content -->
        <div class="z-30 text-center px-6 relative">
            <h1 class="text-5xl sm:text-6xl font-extrabold text-gray-900 mb-2">Join the Chatvolution</h1>
            <p class="text-lg sm:text-xl text-gray-600 max-w-2xl mx-auto mb-8">Ask questions, share ideas, and build connections with each other in our thriving community.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="openModal('joinModal')" class="group px-8 py-3 rounded-full bg-jive-purple hover:bg-purple-700 text-white font-semibold shadow-md transition transform hover:scale-105 active:scale-95 flex items-center justify-center space-x-2">
                    <span>Explore Now</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
                <a href="{{ route('forum') }}" class="px-8 py-3 rounded-full border-2 border-black bg-white text-black font-semibold transition">View Discussions</a>
            </div>
        </div>
    </main>

    <div class="hero-fade absolute bottom-0 left-0 right-0 h-36 pointer-events-none"></div>

    <!-- Home Previews: Forum + Community -->
    <section class="home-previews max-w-7xl mx-auto px-6 py-10">
        <div class="home-grid grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold">Featured Discussions</h2>
                    <a href="{{ route('forum') }}" class="text-sm font-bold underline">View all</a>
                </div>
                <div class="grid gap-4">
                    @forelse($featuredPosts ?? [] as $post)
                        <article data-post-id="{{ $post->id }}" class="post-card post-clickable cursor-pointer">
                            <div class="post-header">
                                <h3 class="text-lg font-bold">{{ $post->title }}</h3>
                                <span class="post-category">{{ $post->category->name ?? 'General' }}</span>
                            </div>
                            <p class="post-body">{{ Str::limit($post->content, 180) }}</p>
                            <div class="post-footer">
                                <span>By {{ $post->user->name ?? 'Anonymous' }}</span>
                                <span>{{ $post->created_at->diffForHumans() ?? 'Recently' }}</span>
                            </div>
                        </article>
                    @empty
                        <div class="post-card">
                            <h3 class="text-lg font-bold">No discussions yet</h3>
                            <p class="text-muted">Be the first to start a discussion in our community.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            <aside>
                <div class="sidebar-section">
                    <h3 class="text-lg font-bold mb-3">Communities</h3>
                    <ul class="space-y-2">
                        @forelse($categories ?? [] as $category)
                            <li>
                                <a href="{{ url('/forum') }}?category={{ $category->id }}" class="category-link flex items-center gap-3">
                                    <span class="px-3 py-2 rounded-full bg-white border-2 border-black">{{ $category->icon ?? '📁' }}</span>
                                    <span class="font-medium">{{ $category->name }}</span>
                                </a>
                            </li>
                        @empty
                            <li class="category-link flex items-center gap-3"><span class="px-3 py-2 rounded-full bg-white border-2 border-black">�</span> Movies</li>
                            <li class="category-link flex items-center gap-3"><span class="px-3 py-2 rounded-full bg-white border-2 border-black">🏀</span> Sports</li>
                            <li class="category-link flex items-center gap-3"><span class="px-3 py-2 rounded-full bg-white border-2 border-black">🍰</span> Baking</li>
                        @endforelse
                    </ul>

                    <div class="mt-6">
                        <a href="{{ route('community') }}" class="btn btn-secondary btn-block">Browse Communities</a>
                    </div>
                </div>
            </aside>
        </div>
    </section>

    <!-- Modal -->
    <div id="joinModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full transform transition-all">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">Welcome!</h2>
                    <button onclick="closeModal('joinModal')" class="text-gray-500 hover:text-gray-700">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <p class="text-gray-600 mb-6">Get started with CozyCircle today. Create an account or explore as a guest.</p>
                <div class="space-y-3">
                    <a href="{{ route('signup') }}" class="block w-full px-4 py-3 bg-jive-purple hover:bg-purple-700 text-white font-semibold rounded-lg transition text-center">
                        Create Account
                    </a>
                    <a href="{{ route('forum') }}" class="block w-full px-4 py-3 border-2 border-black text-black font-semibold rounded-lg hover:bg-black hover:text-white transition text-center">
                        Explore Forum
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Orbit animation */
        .icon-wrapper {
            position: absolute;
            inset: 0;
            animation: orbit var(--dur) linear infinite;
            pointer-events: none;
            z-index: 0;
        }

        .hero-fade {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 9rem;
            pointer-events: none;
            z-index: 10;
            background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(212,196,252,1) 100%);
        }

        .icon {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) translateX(var(--r));
        }

        .icon-inner {
            width: 56px;
            height: 56px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            box-shadow: 0 6px 18px rgba(102, 126, 234, 0.3);
            font-size: 24px;
            animation: counter-orbit var(--dur) linear infinite;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .icon-inner:hover {
            transform: scale(1.15);
            box-shadow: 0 12px 24px rgba(102, 126, 234, 0.5);
        }

        @keyframes orbit {
            to { transform: rotate(360deg); }
        }

        @keyframes counter-orbit {
            to { transform: rotate(-360deg); }
        }

        /* Home preview styles (forum + community) */
        .home-previews { margin-top: 8px; }
        .post-card { background: white; padding: 16px; border-radius: 10px; box-shadow: 4px 4px 0 rgba(0,0,0,0.12); border: 2px solid #000; }
        .post-header h3 { margin: 0; }
        .post-body { color: #4b5563; margin: 8px 0 12px; }
        .post-footer { color: #777; font-size: 0.9rem; display:flex; justify-content:space-between; }
        .category-link { color: #1a1a1a; text-decoration: none; }
        .text-muted { color: #777; }
    </style>

    <script>
        function openModal(modalId) {
            document.getElementById(modalId).classList.remove('hidden');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('hidden');
        }

        // Close modal when clicking outside
        document.querySelectorAll('[id$="Modal"]').forEach(modal => {
            modal.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.classList.add('hidden');
                }
            });
        });
    </script>
</main>
</div>
@endsection
