<nav class="fixed inset-x-0 top-4 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white/90 backdrop-blur-sm border-2 border-black rounded-2xl shadow-[4px_4px_0_rgba(0,0,0,0.15)] px-4 py-3 flex items-center justify-between gap-4">
            <!-- Logo -->
            <div class="flex items-center gap-3">
                <div class="text-2xl font-black">Cozy<span class="font-light italic">Circle</span></div>
                <span class="hidden sm:inline-block bg-jive-yellow border border-black px-3 py-1 rounded-full text-sm font-bold shadow-[2px_2px_0_rgba(0,0,0,1)]">Community</span>
            </div>

            <!-- Menu Items -->
            <div class="hidden md:flex items-center space-x-3">
                <a href="<?php echo e(route('home')); ?>" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Home</a>
                <a href="<?php echo e(route('forum')); ?>" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Forum</a>
                <a href="<?php echo e(route('community')); ?>" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Community</a>
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('profile')); ?>" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Profile</a>
                <?php endif; ?>
            </div>

            <!-- Auth Buttons / Mobile Menu -->
            <div class="flex items-center gap-3">
                <?php if(auth()->guard()->guest()): ?>
                <a href="<?php echo e(route('login')); ?>" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 transition">Sign In</a>
                <a href="<?php echo e(route('signup')); ?>" class="px-3 py-2 text-sm font-medium text-white bg-jive-purple hover:bg-purple-700 rounded-md shadow-md">Join Now</a>
                <?php endif; ?>

                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(route('profile')); ?>" class="px-3 py-2 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-100 transition"><?php echo e(Auth::user()->name ?? 'Profile'); ?></a>
                <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="px-3 py-2 text-sm font-medium text-white bg-red-500 hover:bg-red-600 rounded-md">Logout</button>
                </form>
                <?php endif; ?>

                <button id="mobileMenuToggle" class="md:hidden p-2 rounded-md bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M3 5h14M3 10h14M3 15h14" clip-rule="evenodd" /></svg>
                </button>
            </div>
        </div>
    </div>

    <script>
        // basic mobile menu toggle (could be expanded)
        document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
            alert('Mobile menu - expand if needed');
        });
    </script>
</nav>
<?php /**PATH C:\Vscode\WebProg AOL\CozyCircle2\CozyCircle\resources\views/components/navbar.blade.php ENDPATH**/ ?>