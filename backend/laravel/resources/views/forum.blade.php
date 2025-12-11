<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forum Discussions - CozyCircle</title>
</head>
<body class="bg-white dark:bg-gray-900 min-h-screen flex flex-col">
    @include('components.navbar')
    
    <main class="flex-1">
        <div class="max-w-6xl mx-auto px-6 py-12">
            <!-- Header -->
            <div class="mb-12">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">Community Forum</h1>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-6">Join discussions, ask questions, and connect with other members</p>
                
                <!-- Create Post Button -->
                <button onclick="openModal('newPostModal')" class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg shadow-lg transition transform hover:scale-105 active:scale-95 flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    <span>Start a Discussion</span>
                </button>
            </div>

            <!-- Forum Categories -->
            <div class="grid md:grid-cols-2 gap-6 mb-12">
                <!-- General Discussion -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-200 dark:border-gray-700 p-6 cursor-pointer" onclick="openModal('categoryModal')">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">General Discussion</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Talk about anything CozyCircle</p>
                        </div>
                        <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-full text-xs font-semibold">24 topics</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Last post: 2 hours ago by <span class="font-semibold">Sarah Johnson</span></p>
                    </div>
                </div>

                <!-- Questions & Answers -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-200 dark:border-gray-700 p-6 cursor-pointer" onclick="openModal('categoryModal')">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Questions & Answers</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Ask questions and get expert answers</p>
                        </div>
                        <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded-full text-xs font-semibold">156 topics</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Last post: 30 min ago by <span class="font-semibold">Alex Chen</span></p>
                    </div>
                </div>

                <!-- Introductions -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-200 dark:border-gray-700 p-6 cursor-pointer" onclick="openModal('categoryModal')">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Introductions</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Introduce yourself to the community</p>
                        </div>
                        <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded-full text-xs font-semibold">89 topics</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Last post: 1 day ago by <span class="font-semibold">Jordan Smith</span></p>
                    </div>
                </div>

                <!-- Events & Meetups -->
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg hover:shadow-xl transition border border-gray-200 dark:border-gray-700 p-6 cursor-pointer" onclick="openModal('categoryModal')">
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Events & Meetups</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">Organize and discover community events</p>
                        </div>
                        <span class="px-3 py-1 bg-orange-100 dark:bg-orange-900 text-orange-600 dark:text-orange-300 rounded-full text-xs font-semibold">12 topics</span>
                    </div>
                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Last post: 3 days ago by <span class="font-semibold">Maria Garcia</span></p>
                    </div>
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Recent Discussions</h2>
                </div>
                
                <div class="divide-y divide-gray-200 dark:divide-gray-700">
                    @php
                        $discussions = [
                            [
                                'title' => 'Best practices for community engagement',
                                'author' => 'Sarah Johnson',
                                'replies' => 12,
                                'views' => 234,
                                'time' => '2 hours ago',
                                'category' => 'General',
                                'color' => 'blue'
                            ],
                            [
                                'title' => 'How to improve my profile?',
                                'author' => 'Alex Chen',
                                'replies' => 8,
                                'views' => 145,
                                'time' => '4 hours ago',
                                'category' => 'Questions',
                                'color' => 'green'
                            ],
                            [
                                'title' => 'Excited to join this amazing community!',
                                'author' => 'Jordan Smith',
                                'replies' => 15,
                                'views' => 289,
                                'time' => '1 day ago',
                                'category' => 'Introductions',
                                'color' => 'purple'
                            ],
                            [
                                'title' => 'Monthly virtual meetup - Register now!',
                                'author' => 'Maria Garcia',
                                'replies' => 23,
                                'views' => 456,
                                'time' => '3 days ago',
                                'category' => 'Events',
                                'color' => 'orange'
                            ],
                        ];
                    @endphp

                    @foreach($discussions as $discussion)
                    <div class="p-6 hover:bg-gray-50 dark:hover:bg-gray-700 transition cursor-pointer">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <span class="px-2.5 py-1 bg-{{ $discussion['color'] }}-100 dark:bg-{{ $discussion['color'] }}-900 text-{{ $discussion['color'] }}-600 dark:text-{{ $discussion['color'] }}-300 text-xs font-semibold rounded">
                                        {{ $discussion['category'] }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white hover:text-blue-600 dark:hover:text-blue-400">
                                    {{ $discussion['title'] }}
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                    by <span class="font-medium">{{ $discussion['author'] }}</span> • {{ $discussion['time'] }}
                                </p>
                            </div>
                            <div class="flex items-center space-x-6 text-right">
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $discussion['replies'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">replies</p>
                                </div>
                                <div>
                                    <p class="text-lg font-semibold text-gray-900 dark:text-white">{{ $discussion['views'] }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">views</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </main>

    <!-- New Post Modal -->
    <div id="newPostModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-lg w-full max-h-96 overflow-y-auto">
            <div class="p-6 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Start a Discussion</h2>
                <button onclick="closeModal('newPostModal')" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="p-6 space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Title</label>
                    <input type="text" placeholder="What's on your mind?" class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Category</label>
                    <select class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option>General Discussion</option>
                        <option>Questions & Answers</option>
                        <option>Introductions</option>
                        <option>Events & Meetups</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Description</label>
                    <textarea rows="3" placeholder="Share more details..." class="w-full px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>
                <button class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                    Post Discussion
                </button>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div id="categoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Coming Soon!</h2>
                <p class="text-gray-600 dark:text-gray-400 mb-6">Detailed category view and discussion threads are coming soon. For now, you can create new discussions using the "Start a Discussion" button.</p>
                <button onclick="closeModal('categoryModal')" class="w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                    Got it
                </button>
            </div>
        </div>
    </div>

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
</body>
</html>
