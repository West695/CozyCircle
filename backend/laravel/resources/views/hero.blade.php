<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CozyCircle - Join the Chatvolution</title>
</head>
<body class="bg-white dark:bg-gray-900 min-h-screen flex flex-col">
    @include('components.navbar')
    
    <main class="flex-1 flex items-center justify-center p-6">
    <main class="relative w-full max-w-5xl h-[720px] flex items-center justify-center">
        <!-- Concentric rings -->
        <div class="absolute rounded-full border border-gray-200 dark:border-gray-700 w-[420px] h-[420px] opacity-60" />
        <div class="absolute rounded-full border border-gray-100 dark:border-gray-800 w-[560px] h-[560px] opacity-50" />
        <div class="absolute rounded-full border border-gray-100 dark:border-gray-800 w-[700px] h-[700px] opacity-40" />

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
            <h1 class="text-6xl font-extrabold text-gray-900 dark:text-white mb-2">Join the Chatvolution</h1>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-2xl mx-auto mb-8">Ask questions, share ideas, and build connections with each other in our thriving community.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <button onclick="openModal('joinModal')" class="group px-8 py-4 rounded-full bg-blue-600 hover:bg-blue-700 text-white font-semibold shadow-xl transition transform hover:scale-105 active:scale-95 flex items-center justify-center space-x-2">
                    <span>Explore Now</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </button>
                <a href="{{ route('forum') }}" class="px-8 py-4 rounded-full border-2 border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-800 font-semibold transition">
                    View Discussions
                </a>
            </div>
        </div>
    </main>

    <!-- Modal -->
    <div id="joinModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center p-4 z-50">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full transform transition-all">
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Welcome!</h2>
                    <button onclick="closeModal('joinModal')" class="text-gray-500 hover:text-gray-700 dark:hover:text-gray-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
                <p class="text-gray-600 dark:text-gray-300 mb-6">Get started with CozyCircle today. Create an account or explore as a guest.</p>
                <div class="space-y-3">
                    <a href="{{ route('signup') }}" class="block w-full px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition text-center">
                        Create Account
                    </a>
                    <a href="{{ route('forum') }}" class="block w-full px-4 py-3 border-2 border-blue-600 text-blue-600 dark:text-blue-400 font-semibold rounded-lg hover:bg-blue-50 dark:hover:bg-gray-700 transition text-center">
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
</body>
</html>
