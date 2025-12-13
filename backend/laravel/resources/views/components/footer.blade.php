<footer class="mt-12 bg-jive-yellow border-t-2 border-black relative z-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 flex flex-col md:flex-row items-center justify-between gap-4">
        <div class="flex items-center gap-3">
            <div class="text-2xl font-black">Cozy<span class="font-light italic">Circle</span></div>
            <span class="text-sm font-bold">&copy; 2025 CozyCircle</span>
        </div>
        <nav class="flex items-center gap-4 text-sm">
            <a href="{{ route('home') }}" class="underline decoration-black decoration-2 px-2 py-1">Home</a>
            <a href="{{ route('forum') }}" class="underline decoration-black decoration-2 px-2 py-1">Forum</a>
            <a href="{{ route('community') }}" class="underline decoration-black decoration-2 px-2 py-1">Community</a>
            <a href="{{ route('login') }}" class="underline decoration-black decoration-2 px-2 py-1">Sign In</a>
        </nav>
    </div>
</footer>