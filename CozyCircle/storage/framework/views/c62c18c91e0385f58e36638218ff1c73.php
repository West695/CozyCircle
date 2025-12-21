<?php $__env->startSection('content'); ?>
    
    <h2 class="text-2xl font-bold mb-6 text-center">Welcome Back!</h2>

    <form method="POST" action="<?php echo e(route('login.attempt')); ?>">
        <?php echo csrf_field(); ?> 
x
        <div class="mb-4">
            <label class="block font-bold text-sm mb-1" for="email">Email</label>
            <input id="email" 
                   type="email" 
                   name="email" 
                   value="<?php echo e(old('email')); ?>"
                   class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black focus:ring-0 outline-none transition-colors"
                   required autofocus>
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-6">
            <label class="block font-bold text-sm mb-1" for="password">Password</label>
            <input id="password" 
                   type="password" 
                   name="password" 
                   class="w-full px-4 py-3 rounded-lg border-2 border-gray-200 focus:border-black focus:ring-0 outline-none transition-colors"
                   required>
            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="text-red-500 text-xs mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="flex items-center justify-between mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="remember" class="rounded border-gray-300 text-purple-600 shadow-sm focus:ring-purple-500">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>
            
            <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-purple-700 hover:underline font-semibold">
                Forgot Password?
            </a>
        </div>

        <button type="submit" class="w-full bg-black text-white font-bold py-3 rounded-xl hover:bg-gray-800 transition-transform active:scale-95 shadow-lg">
            Log In
        </button>
    </form>

    <div class="mt-6 text-center text-sm">
        Don't have an account? 
        <a href="<?php echo e(route('register')); ?>" class="font-bold underline decoration-jive-yellow decoration-4 underline-offset-2 hover:text-purple-700">
            Sign Up
        </a>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Vscode\WebProg AOL\CozyCircle2\CozyCircle\resources\views/login.blade.php ENDPATH**/ ?>