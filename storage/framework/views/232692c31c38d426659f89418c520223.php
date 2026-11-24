<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

?>

<div
    class="relative min-h-screen w-full overflow-hidden bg-slate-900"
    style="
        background-image: url('<?php echo e(asset('images/client-login.png')); ?>');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    "
>

    
    <div class="absolute inset-0 bg-slate-950/20"></div>


    
    <div
        class="absolute inset-0 bg-gradient-to-r
               from-transparent
               via-transparent
               to-slate-950/25
               pointer-events-none"
    ></div>


    
    <div
        class="relative z-10 min-h-screen
               flex items-center justify-center
               lg:justify-end
               px-4 sm:px-6 lg:px-16
               py-8"
    >

        
        <div class="w-full max-w-md">

            <div
                class="rounded-3xl
                       bg-white/96
                       backdrop-blur-xl
                       shadow-2xl
                       border border-white/70
                       px-6 py-8
                       sm:px-9 sm:py-10"
            >

                
                <div class="flex justify-center mb-6">

                    <div
                        class="w-16 h-16
                               rounded-2xl
                               bg-blue-600
                               flex items-center justify-center
                               shadow-xl
                               shadow-blue-600/30"
                    >

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            class="w-9 h-9 text-white"
                        >

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 2.5C12 2.5 5.5 10 5.5 14.5A6.5 6.5 0 0012 21a6.5 6.5 0 006.5-6.5C18.5 10 12 2.5 12 2.5z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M9.5 15.5c.5 1.2 1.4 1.9 2.8 2"
                            />

                        </svg>

                    </div>

                </div>


                
                <div class="text-center mb-8">

                    <h1
                        class="text-3xl sm:text-4xl
                               font-extrabold
                               tracking-tight
                               text-slate-800"
                    >
                        Welcome Back
                    </h1>

                    <p
                        class="mt-2
                               text-sm sm:text-base
                               text-slate-500"
                    >
                        Sign in to your Maji Mazuri account
                    </p>

                </div>


                
                <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-5','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-5','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>


                
                <form
                    wire:submit="login"
                    class="space-y-5"
                >

                    
                    <div>

                        <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'email','value' => __('Email Address'),'class' => 'font-semibold text-slate-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'email','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Email Address')),'class' => 'font-semibold text-slate-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>

                        <div class="relative mt-2">

                            
                            <div
                                class="absolute inset-y-0 left-0
                                       pl-4
                                       flex items-center
                                       pointer-events-none"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="w-5 h-5 text-slate-400"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M21.75 6.75v10.5A2.25 2.25 0 0119.5 19.5h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0l-9.75 6.75L2.25 6.75"
                                    />

                                </svg>

                            </div>


                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['wire:model' => 'form.email','id' => 'email','class' => 'block w-full
                                       pl-11 pr-4 py-3.5
                                       rounded-xl
                                       border-slate-300
                                       bg-white
                                       text-slate-800
                                       placeholder-slate-400
                                       shadow-sm
                                       focus:border-blue-500
                                       focus:ring-blue-500
                                       transition','type' => 'email','name' => 'email','required' => true,'autofocus' => true,'autocomplete' => 'username','placeholder' => 'Enter your email address']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'form.email','id' => 'email','class' => 'block w-full
                                       pl-11 pr-4 py-3.5
                                       rounded-xl
                                       border-slate-300
                                       bg-white
                                       text-slate-800
                                       placeholder-slate-400
                                       shadow-sm
                                       focus:border-blue-500
                                       focus:ring-blue-500
                                       transition','type' => 'email','name' => 'email','required' => true,'autofocus' => true,'autocomplete' => 'username','placeholder' => 'Enter your email address']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                        </div>


                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('form.email'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('form.email')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>

                    </div>


                    
                    <div>

                        <div
                            class="flex items-center justify-between gap-4"
                        >

                            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'password','value' => __('Password'),'class' => 'font-semibold text-slate-700']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'password','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(__('Password')),'class' => 'font-semibold text-slate-700']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>


                            
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(Route::has('password.request')): ?>

                                <a
                                    href="<?php echo e(route('password.request')); ?>"
                                    wire:navigate
                                    class="text-sm
                                           font-semibold
                                           text-blue-600
                                           hover:text-blue-700
                                           hover:underline
                                           transition
                                           whitespace-nowrap"
                                >
                                    Forgot password?
                                </a>

                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        </div>


                        <div class="relative mt-2">

                            
                            <div
                                class="absolute inset-y-0 left-0
                                       pl-4
                                       flex items-center
                                       pointer-events-none"
                            >

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke-width="1.7"
                                    stroke="currentColor"
                                    class="w-5 h-5 text-slate-400"
                                >

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M16.5 10.5V7.875a4.5 4.5 0 00-9 0V10.5m-1.125 0h11.25A1.875 1.875 0 0119.5 12.375v6.75A1.875 1.875 0 0117.625 21h-11.25A1.875 1.875 0 014.5 19.125v-6.75A1.875 1.875 0 016.375 10.5z"
                                    />

                                </svg>

                            </div>


                            <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['wire:model' => 'form.password','id' => 'password','class' => 'block w-full
                                       pl-11 pr-4 py-3.5
                                       rounded-xl
                                       border-slate-300
                                       bg-white
                                       text-slate-800
                                       placeholder-slate-400
                                       shadow-sm
                                       focus:border-blue-500
                                       focus:ring-blue-500
                                       transition','type' => 'password','name' => 'password','required' => true,'autocomplete' => 'current-password','placeholder' => 'Enter your password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:model' => 'form.password','id' => 'password','class' => 'block w-full
                                       pl-11 pr-4 py-3.5
                                       rounded-xl
                                       border-slate-300
                                       bg-white
                                       text-slate-800
                                       placeholder-slate-400
                                       shadow-sm
                                       focus:border-blue-500
                                       focus:ring-blue-500
                                       transition','type' => 'password','name' => 'password','required' => true,'autocomplete' => 'current-password','placeholder' => 'Enter your password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>

                        </div>


                        <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('form.password'),'class' => 'mt-2']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('form.password')),'class' => 'mt-2']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>

                    </div>


                    
                    <div>

                        <label
                            for="remember"
                            class="inline-flex
                                   items-center
                                   cursor-pointer
                                   select-none"
                        >

                            <input
                                wire:model="form.remember"
                                id="remember"
                                type="checkbox"
                                name="remember"
                                class="w-4 h-4
                                       rounded
                                       border-slate-300
                                       text-blue-600
                                       shadow-sm
                                       focus:ring-blue-500
                                       focus:ring-offset-0"
                            >

                            <span
                                class="ms-2
                                       text-sm
                                       font-medium
                                       text-slate-600"
                            >
                                <?php echo e(__('Remember me')); ?>

                            </span>

                        </label>

                    </div>


                    
                    <div class="pt-1">

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            class="w-full
                                   min-h-[52px]
                                   flex items-center
                                   justify-center
                                   gap-2
                                   px-6 py-3.5
                                   rounded-xl
                                   bg-blue-600
                                   hover:bg-blue-700
                                   active:bg-blue-800
                                   text-white
                                   font-bold
                                   shadow-lg
                                   shadow-blue-600/25
                                   hover:shadow-blue-600/35
                                   transition-all
                                   duration-200
                                   disabled:opacity-60
                                   disabled:cursor-not-allowed
                                   disabled:hover:bg-blue-600"
                        >

                            
                            <svg
                                wire:loading
                                class="animate-spin w-5 h-5"
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                            >

                                <circle
                                    class="opacity-25"
                                    cx="12"
                                    cy="12"
                                    r="10"
                                    stroke="currentColor"
                                    stroke-width="4"
                                />

                                <path
                                    class="opacity-75"
                                    fill="currentColor"
                                    d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                                />

                            </svg>


                            
                            <svg
                                wire:loading.remove
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                class="w-5 h-5"
                            >

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-9a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 004.5 21h9a2.25 2.25 0 002.25-2.25V15"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 12h9m0 0l-3.75-3.75M21 12l-3.75 3.75"
                                />

                            </svg>


                            <span wire:loading.remove>
                                <?php echo e(__('Log in')); ?>

                            </span>


                            <span wire:loading>
                                Signing in...
                            </span>

                        </button>

                    </div>

                </form>


                
                <div
                    class="mt-8
                           pt-6
                           border-t
                           border-slate-200"
                >

                    <p
                        class="text-xs
                               font-medium
                               text-slate-400
                               text-center"
                    >
                        Maji Mazuri Water Billing & Customer
                        Management System
                    </p>

                    <p
                        class="text-xs
                               text-slate-400
                               mt-1
                               text-center"
                    >
                        Secure access for authorized users
                    </p>

                </div>

            </div>

        </div>

    </div>

</div><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\livewire\pages\auth\login.blade.php ENDPATH**/ ?>