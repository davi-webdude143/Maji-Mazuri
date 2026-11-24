<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

?>



<div x-data="{ open: false }">


<nav
    class="fixed inset-y-0 left-0 z-50 w-64 bg-[#0B1F4D] text-white shadow-xl hidden lg:flex lg:flex-col"
>

    
    <div class="h-20 px-6 flex items-center border-b border-white/10">

        <a
            href="<?php echo e(route('dashboard')); ?>"
            wire:navigate
            class="flex items-center gap-3"
        >
            <div
                class="w-10 h-10 rounded-xl bg-[#1D63D8]
                       flex items-center justify-center shadow-lg"
            >
                <svg
                    class="w-6 h-6 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 3.5C12 3.5 5 11.2 5 16.2a7 7 0 0014 0C19 11.2 12 3.5 12 3.5z"
                    />
                </svg>
            </div>

            <div>
                <div class="text-lg font-bold tracking-tight">
                    Pure Tide
                </div>

                <div class="text-xs text-blue-200">
                    Mazuri Ltd
                </div>
            </div>
        </a>

    </div>


    
    <div class="flex-1 px-4 py-6 overflow-y-auto">

        <p
            class="px-3 mb-3 text-[10px] font-bold uppercase
                   tracking-[0.18em] text-blue-200/60"
        >
            Main Menu
        </p>

        <div class="space-y-1">

            
            <a
                href="<?php echo e(route('dashboard')); ?>"
                wire:navigate
                class="group flex items-center gap-3 px-3 py-3
                       rounded-xl transition
                       <?php echo e(request()->routeIs('dashboard')
                            ? 'bg-[#1D63D8] text-white shadow-md'
                            : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
            >
                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l9-9 9 9M5 10v10h14V10M9 20v-6h6v6"
                    />
                </svg>

                <span class="font-semibold text-sm">
                    Dashboard
                </span>
            </a>


            
            <a
                href="<?php echo e(route('customers.index')); ?>"
                wire:navigate
                class="group flex items-center gap-3 px-3 py-3
                       rounded-xl transition
                       <?php echo e(request()->routeIs('customers.*')
                            ? 'bg-[#1D63D8] text-white shadow-md'
                            : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
            >
                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M17 20h5V4H2v16h5m10 0v-6H7v6m10 0H7M8 8h8M8 12h4"
                    />
                </svg>

                <span class="font-semibold text-sm">
                    Customers
                </span>
            </a>


            
            <a
                href="<?php echo e(route('meters.index')); ?>"
                wire:navigate
                class="group flex items-center gap-3 px-3 py-3
                       rounded-xl transition
                       <?php echo e(request()->routeIs('meters.*')
                            ? 'bg-[#1D63D8] text-white shadow-md'
                            : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
            >
                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 8v4l3 2m5-2a8 8 0 11-16 0 8 8 0 0116 0z"
                    />
                </svg>

                <span class="font-semibold text-sm">
                    Meters
                </span>
            </a>


            
            <a
                href="<?php echo e(route('meter-readings.index')); ?>"
                wire:navigate
                class="group flex items-center gap-3 px-3 py-3
                       rounded-xl transition
                       <?php echo e(request()->routeIs('meter-readings.*')
                            ? 'bg-[#1D63D8] text-white shadow-md'
                            : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
            >
                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 17v-2a4 4 0 014-4h0a4 4 0 014 4v2M7 7h10M7 11h4M5 21h14"
                    />
                </svg>

                <span class="font-semibold text-sm">
                    Meter Readings
                </span>
            </a>


            
            <a
                href="<?php echo e(route('bills.index')); ?>"
                wire:navigate
                class="group flex items-center gap-3 px-3 py-3
                       rounded-xl transition
                       <?php echo e(request()->routeIs('bills.*')
                            ? 'bg-[#1D63D8] text-white shadow-md'
                            : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
            >
                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M7 3h10a2 2 0 012 2v14a2 2 0 01-2 2H7a2 2 0 01-2-2V5a2 2 0 012-2zM9 8h6M9 12h6M9 16h4"
                    />
                </svg>

                <span class="font-semibold text-sm">
                    Billing
                </span>
            </a>


            
            <a
                href="<?php echo e(route('payments.index')); ?>"
                wire:navigate
                class="group flex items-center gap-3 px-3 py-3
                       rounded-xl transition
                       <?php echo e(request()->routeIs('payments.*')
                            ? 'bg-[#1D63D8] text-white shadow-md'
                            : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
            >
                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 7h18v10H3V7zm3 3h5m-5 4h3"
                    />
                </svg>

                <span class="font-semibold text-sm">
                    Payments
                </span>
            </a>


            
            <a
                href="<?php echo e(route('reports.index')); ?>"
                wire:navigate
                class="group flex items-center gap-3 px-3 py-3
                       rounded-xl transition
                       <?php echo e(request()->routeIs('reports.*')
                            ? 'bg-[#1D63D8] text-white shadow-md'
                            : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
            >
                <svg
                    class="w-5 h-5 shrink-0"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M4 19V5m0 14h16M8 16v-4m4 4V8m4 8v-7"
                    />
                </svg>

                <span class="font-semibold text-sm">
                    Reports
                </span>
            </a>


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array(auth()->user()->role, ['admin', 'manager'], true)): ?>

                <div class="pt-5 mt-5 border-t border-white/10">

                    <p
                        class="px-3 mb-3 text-[10px] font-bold uppercase
                               tracking-[0.18em] text-blue-200/60"
                    >
                        Administration
                    </p>


                    
                    <a
                        href="<?php echo e(route('users.index')); ?>"
                        wire:navigate
                        class="group flex items-center gap-3 px-3 py-3
                               rounded-xl transition
                               <?php echo e(request()->routeIs('users.*')
                                    ? 'bg-[#1D63D8] text-white shadow-md'
                                    : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
                    >
                        <svg
                            class="w-5 h-5 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2m7-8a4 4 0 100-8 4 4 0 000 8zm7-3a4 4 0 100-8m4 15v-2a4 4 0 00-3-3.87"
                            />
                        </svg>

                        <span class="font-semibold text-sm">
                            Users
                        </span>
                    </a>


                    
                    <a
                        href="<?php echo e(route('settings.index')); ?>"
                        wire:navigate
                        class="group flex items-center gap-3 px-3 py-3
                               rounded-xl transition
                               <?php echo e(request()->routeIs('settings.*')
                                    ? 'bg-[#1D63D8] text-white shadow-md'
                                    : 'text-blue-100 hover:bg-white/10 hover:text-white'); ?>"
                    >
                        <svg
                            class="w-5 h-5 shrink-0"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M12 15.5a3.5 3.5 0 100-7 3.5 3.5 0 000 7z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M19.4 15a1.7 1.7 0 00.34 1.88l.06.06-1.8 1.8-.06-.06a1.7 1.7 0 00-1.88-.34 1.7 1.7 0 00-1.03 1.56V22h-2.55v-.1a1.7 1.7 0 00-1.03-1.56 1.7 1.7 0 00-1.88.34l-.06.06-1.8-1.8.06-.06A1.7 1.7 0 008.1 15a1.7 1.7 0 00-1.56-1.03H6.5v-2.55h.04A1.7 1.7 0 008.1 10a1.7 1.7 0 00-.34-1.88L7.7 8.06l1.8-1.8.06.06a1.7 1.7 0 001.88.34 1.7 1.7 0 001.03-1.56V5h2.55v.1a1.7 1.7 0 001.03 1.56 1.7 1.7 0 001.88-.34l.06-.06 1.8 1.8-.06.06A1.7 1.7 0 0019.4 10a1.7 1.7 0 001.56 1.03H21v2.55h-.04A1.7 1.7 0 0019.4 15z"
                            />
                        </svg>

                        <span class="font-semibold text-sm">
                            Settings
                        </span>
                    </a>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

        </div>

    </div>


    
    <div class="p-4 border-t border-white/10">

        <div class="flex items-center gap-3 px-2 py-2">

            <div
                class="w-10 h-10 rounded-full bg-[#5BA3E8]
                       flex items-center justify-center shrink-0"
            >
                <span class="font-bold text-[#0B1F4D]">
                    <?php echo e(strtoupper(substr(auth()->user()->name, 0, 1))); ?>

                </span>
            </div>

            <div class="min-w-0 flex-1">

                <p class="text-sm font-semibold text-white truncate">
                    <?php echo e(auth()->user()->name); ?>

                </p>

                <p class="text-xs text-blue-200 truncate">
                    <?php echo e(ucfirst(auth()->user()->role)); ?>

                </p>

            </div>

        </div>


        
        <a
            href="<?php echo e(route('profile')); ?>"
            wire:navigate
            class="mt-3 flex items-center gap-3 px-3 py-2.5
                   rounded-xl text-blue-100
                   hover:bg-white/10 hover:text-white transition"
        >
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM4 21a8 8 0 0116 0"
                />
            </svg>

            <span class="text-sm font-medium">
                Profile
            </span>
        </a>


        
        <button
            wire:click="logout"
            class="w-full flex items-center gap-3 px-3 py-2.5
                   rounded-xl text-blue-100
                   hover:bg-red-500/20 hover:text-red-200 transition"
        >
            <svg
                class="w-5 h-5"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H6a2 2 0 01-2-2V7a2 2 0 012-2h5a2 2 0 012 2v1"
                />
            </svg>

            <span class="text-sm font-medium">
                Log Out
            </span>
        </button>

    </div>

</nav>



<div
    class="lg:hidden fixed top-0 left-0 right-0 z-50
           bg-[#0B1F4D] text-white
           border-b border-white/10"
>

    <div class="h-16 px-4 flex items-center justify-between">

        <a
            href="<?php echo e(route('dashboard')); ?>"
            wire:navigate
            class="flex items-center gap-2"
        >
            <div
                class="w-9 h-9 rounded-xl bg-[#1D63D8]
                       flex items-center justify-center"
            >
                <svg
                    class="w-5 h-5 text-white"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 3.5C12 3.5 5 11.2 5 16.2a7 7 0 0014 0C19 11.2 12 3.5 12 3.5z"
                    />
                </svg>
            </div>

            <span class="font-bold">
                Pure Tide Mazuri
            </span>
        </a>


        
        <button
            @click="open = !open"
            class="p-2 rounded-lg hover:bg-white/10 transition"
        >
            <svg
                class="w-6 h-6"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path
                    x-show="!open"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16"
                />

                <path
                    x-show="open"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12"
                />
            </svg>
        </button>

    </div>


    
    <div
        x-show="open"
        x-transition
        class="border-t border-white/10
               bg-[#0B1F4D]
               px-4 py-4 space-y-1"
    >

        
        <a
            href="<?php echo e(route('dashboard')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Dashboard
        </a>


        
        <a
            href="<?php echo e(route('customers.index')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Customers
        </a>


        
        <a
            href="<?php echo e(route('meters.index')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Meters
        </a>


        
        <a
            href="<?php echo e(route('meter-readings.index')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Meter Readings
        </a>


        
        <a
            href="<?php echo e(route('bills.index')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Billing
        </a>


        
        <a
            href="<?php echo e(route('payments.index')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Payments
        </a>


        
        <a
            href="<?php echo e(route('reports.index')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Reports
        </a>


        
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(in_array(auth()->user()->role, ['admin', 'manager'], true)): ?>

            <div class="border-t border-white/10 my-3"></div>


            
            <a
                href="<?php echo e(route('users.index')); ?>"
                wire:navigate
                class="block px-3 py-3 rounded-xl
                       text-blue-100 hover:bg-white/10"
            >
                Users
            </a>


            
            <a
                href="<?php echo e(route('settings.index')); ?>"
                wire:navigate
                class="block px-3 py-3 rounded-xl
                       text-blue-100 hover:bg-white/10"
            >
                Settings
            </a>

        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        <div class="border-t border-white/10 my-3"></div>


        
        <a
            href="<?php echo e(route('profile')); ?>"
            wire:navigate
            class="block px-3 py-3 rounded-xl
                   text-blue-100 hover:bg-white/10"
        >
            Profile
        </a>


        
        <button
            wire:click="logout"
            class="w-full text-left px-3 py-3 rounded-xl
                   text-blue-100
                   hover:bg-red-500/20
                   hover:text-red-200"
        >
            Log Out
        </button>

    </div>

</div>

</div><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\livewire\layout\navigation.blade.php ENDPATH**/ ?>