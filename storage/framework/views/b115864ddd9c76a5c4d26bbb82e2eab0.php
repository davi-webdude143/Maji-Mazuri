<!DOCTYPE html>
<html
    lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>"
    x-data="{
        darkMode: localStorage.getItem('theme') === 'dark'
    }"
    x-init="
        document.documentElement.classList.toggle('dark', darkMode);

        $watch('darkMode', value => {
            localStorage.setItem('theme', value ? 'dark' : 'light');
            document.documentElement.classList.toggle('dark', value);
        });
    "
    :class="{ 'dark': darkMode }"
>

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <meta
        name="csrf-token"
        content="<?php echo e(csrf_token()); ?>"
    >

    <title>
        <?php if (! empty(trim($__env->yieldContent('title')))): ?>
            <?php echo $__env->yieldContent('title'); ?> -
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo e(config('app.name', 'Pure Tide Mazuri Ltd')); ?>

    </title>


    

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>


    

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    >


    

    <?php echo app('Illuminate\Foundation\Vite')([
        'resources/css/app.css',
        'resources/js/app.js'
    ]); ?>

    <?php echo $__env->yieldPushContent('styles'); ?>

</head>


<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-950 transition-colors duration-300">

        

        <?php
$__split = function ($name, $params = []) {
    return [$name, $params];
};
[$__name, $__params] = $__split('layout.navigation', []);

$__key = null;

$__key ??= \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::generateKey('lw-2907248825-0', $__key);

$__html = app('livewire')->mount($__name, $__params, $__key);

echo $__html;

unset($__html);
unset($__key);
unset($__name);
unset($__params);
unset($__split);
if (isset($__slots)) unset($__slots);
?>


        

        <main class="lg:ml-64 pt-16 lg:pt-0 min-h-screen">

            

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($header)): ?>

                <header
                    class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800"
                >
                    <div
                        class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
                    >
                        <?php echo e($header); ?>

                    </div>
                </header>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($slot)): ?>

                
                <?php echo e($slot); ?>


            <?php else: ?>

                
                <?php echo $__env->yieldContent('content'); ?>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </main>

    </div>


    

    <?php echo $__env->yieldPushContent('scripts'); ?>

</body>

</html><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views/layouts/app.blade.php ENDPATH**/ ?>