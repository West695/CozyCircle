<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CozyCircle')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'jive-purple': '#D4C4FC',
                        'jive-yellow': '#FDF5A5',
                    }
                }
            }
        }
    </script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #333;
            background: linear-gradient(135deg, #D4C4FC 0%, #E8D7FF 100%);
            min-height: 100vh;
        }
    </style>
    @stack('styles')
</head>
</script>
<body class="bg-jive-purple min-h-screen relative font-sans flex flex-col">
    <div class="absolute inset-0 pointer-events-none flex items-center justify-center opacity-30">
        <div class="border border-gray-500 rounded-full w-[400px] h-[400px] absolute"></div>
        <div class="border border-gray-500 rounded-full w-[700px] h-[700px] absolute"></div>
        <div class="border border-gray-500 rounded-full w-[1100px] h-[1100px] absolute"></div>
    </div>

    <div class="absolute top-20 left-20 bg-white p-2 rounded-full shadow-sm hidden md:block">
        <span>❤️</span>
    </div>
    <div class="absolute bottom-20 right-20 bg-white p-2 rounded-full shadow-sm hidden md:block">
        <span>🎸</span>
    </div>

    @include('components.navbar')

    <main class="relative z-10 w-full max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 flex-1">
        @yield('content')
    </main>

    @include('components.footer')

    @stack('scripts')
</body>
</html>
