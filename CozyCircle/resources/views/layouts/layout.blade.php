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
</head>
<body class="bg-jive-purple min-h-screen flex items-center justify-center relative overflow-hidden font-sans">

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

    <div class="relative z-10 w-full max-w-md px-6">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-black tracking-tighter mb-2">Cozy<span class="font-light italic">Circle</span></h1>
            <span class="bg-jive-yellow border border-black px-4 py-1 rounded-full text-sm font-bold shadow-[2px_2px_0px_rgba(0,0,0,1)]">
                Community Access
            </span>
        </div>

        <div class="bg-white/90 backdrop-blur-sm border-2 border-black rounded-2xl p-8 shadow-[6px_6px_0px_rgba(0,0,0,0.8)]">
            @yield('content')
        </div>
        
        <div class="text-center mt-6 text-sm text-gray-700">
            &copy; 2025 CozyCircle
        </div>
    </div>

    @unless(request()->routeIs('login','signup','register'))
        @include('components.footer')
    @endunless
</body>
</html>