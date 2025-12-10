<nav class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <div class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    CozyCircle
                </div>
            </div>

            <!-- Menu Items -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('home') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    Home
                </a>
                <a href="{{ route('forum') }}" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    Forum
                </a>
                <a href="#" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    Community
                </a>
            </div>

            <!-- Auth Buttons -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('login') }}" class="px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition">
                    Sign In
                </a>
                <a href="{{ route('signup') }}" class="px-4 py-2 text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-lg shadow-lg transition transform hover:scale-105">
                    Join Now
                </a>
            </div>
        </div>
    </div>
</nav>
