<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>

     <?php $__env->slot('header', null, []); ?> 
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                
                <div class="flex items-center gap-2 text-sm mb-2" style="color: #64748B;">
                    <a
                        href="<?php echo e(route('customers.index')); ?>"
                        class="hover:underline"
                        style="color: #2F80ED;"
                    >
                        Customers
                    </a>

                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 5l7 7-7 7"
                        />
                    </svg>

                    <span>Import</span>
                </div>

                <h2
                    class="font-bold text-2xl"
                    style="color: #16324F;"
                >
                    Import Customers
                </h2>

                <p
                    class="text-sm mt-1"
                    style="color: #64748B;"
                >
                    Add multiple customers and their opening meter readings from a spreadsheet.
                </p>
            </div>

            
            <a
                href="<?php echo e(route('customers.index')); ?>"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                       rounded-xl border bg-white text-sm font-semibold
                       transition hover:shadow-sm"
                style="
                    border-color: #D9E7F5;
                    color: #16324F;
                "
            >
                <svg
                    class="w-4 h-4"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 19l-7-7 7-7"
                    />
                </svg>

                Back to Customers
            </a>

        </div>
     <?php $__env->endSlot(); ?>


    
    <div
        class="min-h-screen py-8"
        style="background: #F8FBFF;"
    >

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">


            
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($errors->any()): ?>

                <div
                    class="mb-6 rounded-2xl border p-5"
                    style="
                        background: #FEF2F2;
                        border-color: #FECACA;
                        color: #991B1B;
                    "
                >

                    <div class="flex items-start gap-3">

                        <div
                            class="w-9 h-9 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background: #FEE2E2;"
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
                                    d="M12 8v4m0 4h.01M10.29 3.86l-7.82 14a2 2 0 001.74 3h15.58a2 2 0 001.74-3l-7.82-14a2 2 0 00-3.42 0z"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3 class="font-semibold">
                                We couldn't process the spreadsheet
                            </h3>

                            <ul class="mt-2 space-y-1 text-sm">
                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>• <?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </ul>
                        </div>

                    </div>

                </div>

            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


            
            
            

            <div
                class="bg-white rounded-2xl border overflow-hidden"
                style="
                    border-color: #D9E7F5;
                    box-shadow: 0 8px 30px rgba(18, 59, 99, 0.05);
                "
            >

                
                <div
                    class="px-6 py-5 border-b flex flex-col sm:flex-row
                           sm:items-center sm:justify-between gap-4"
                    style="border-color: #D9E7F5;"
                >

                    <div class="flex items-center gap-3">

                        <div
                            class="w-11 h-11 rounded-xl flex items-center justify-center"
                            style="background: #F3F8FF;"
                        >
                            <svg
                                class="w-6 h-6"
                                fill="none"
                                stroke="#0B5ED7"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M7 18a4.6 4.6 0 01-.9-9.11A5.5 5.5 0 0116.5 7h.5a4 4 0 010 8h-1m-5-4l3-3m0 0l3 3m-3-3v12"
                                />
                            </svg>
                        </div>

                        <div>
                            <h3
                                class="font-bold text-lg"
                                style="color: #16324F;"
                            >
                                Upload Customer Spreadsheet
                            </h3>

                            <p
                                class="text-sm mt-0.5"
                                style="color: #64748B;"
                            >
                                Upload your customer data for validation and review.
                            </p>
                        </div>

                    </div>


                    
                    <div
                        class="inline-flex items-center gap-2 self-start sm:self-auto
                               rounded-lg px-3 py-1.5 text-xs font-semibold"
                        style="
                            background: #F3F8FF;
                            color: #0B5ED7;
                            border: 1px solid #D9E7F5;
                        "
                    >
                        <svg
                            class="w-4 h-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M7 3h7l4 4v14H7a2 2 0 01-2-2V5a2 2 0 012-2z"
                            />
                        </svg>

                        XLSX / XLS / CSV
                    </div>

                </div>


                <div class="p-6">


                    
                    
                    

                    <form
                        id="customerImportForm"
                        action="<?php echo e(route('customers.import.preview')); ?>"
                        method="POST"
                        enctype="multipart/form-data"
                    >

                        <?php echo csrf_field(); ?>

                        <div
                            id="dropZone"
                            class="relative rounded-2xl border-2 border-dashed
                                   transition-all duration-200"
                            style="
                                border-color: #B8D4F2;
                                background: #F7FBFF;
                            "
                        >

                            <input
                                id="file"
                                name="file"
                                type="file"
                                accept=".xlsx,.xls,.csv"
                                required
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10"
                            >


                            <div
                                id="emptyState"
                                class="px-6 py-12 sm:py-16 text-center"
                            >

                                
                                <div
                                    class="mx-auto w-16 h-16 rounded-2xl
                                           flex items-center justify-center mb-5"
                                    style="background: #EAF4FF;"
                                >

                                    <svg
                                        class="w-8 h-8"
                                        fill="none"
                                        stroke="#0B5ED7"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="1.7"
                                            d="M7 18a4.6 4.6 0 01-.9-9.11A5.5 5.5 0 0116.5 7h.5a4 4 0 010 8h-1m-5-4l3-3m0 0l3 3m-3-3v8"
                                        />
                                    </svg>

                                </div>


                                <h4
                                    class="text-lg font-bold"
                                    style="color: #16324F;"
                                >
                                    Drop your spreadsheet here
                                </h4>

                                <p
                                    class="mt-2 text-sm"
                                    style="color: #64748B;"
                                >
                                    or
                                    <span
                                        class="font-semibold"
                                        style="color: #0B5ED7;"
                                    >
                                        click to browse
                                    </span>
                                    from your computer
                                </p>


                                <div
                                    class="mt-5 inline-flex items-center gap-2
                                           px-3 py-1.5 rounded-lg text-xs"
                                    style="
                                        background: #FFFFFF;
                                        color: #64748B;
                                        border: 1px solid #D9E7F5;
                                    "
                                >
                                    <span
                                        class="w-2 h-2 rounded-full"
                                        style="background: #94A3B8;"
                                    ></span>

                                    No file chosen
                                </div>

                            </div>


                            
                            <div
                                id="selectedState"
                                class="hidden px-6 py-10 sm:py-12"
                            >

                                <div
                                    class="max-w-xl mx-auto rounded-2xl p-5"
                                    style="
                                        background: #FFFFFF;
                                        border: 1px solid #D9E7F5;
                                        box-shadow: 0 5px 20px rgba(18, 59, 99, 0.05);
                                    "
                                >

                                    <div class="flex items-center gap-4">

                                        <div
                                            class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0"
                                            style="background: #DCFCE7;"
                                        >
                                            <svg
                                                class="w-6 h-6"
                                                fill="none"
                                                stroke="#16A34A"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M5 13l4 4L19 7"
                                                />
                                            </svg>
                                        </div>


                                        <div class="min-w-0 flex-1 text-left">

                                            <p
                                                id="fileName"
                                                class="font-semibold truncate"
                                                style="color: #16324F;"
                                            >
                                                File selected
                                            </p>

                                            <p
                                                id="fileDetails"
                                                class="text-xs mt-1"
                                                style="color: #64748B;"
                                            >
                                                Ready to analyze
                                            </p>

                                        </div>

                                    </div>


                                    <div class="mt-5 flex justify-end">

                                        <button
                                            type="button"
                                            id="replaceFile"
                                            class="relative z-20 inline-flex items-center gap-2
                                                   px-3 py-2 rounded-lg text-sm font-semibold
                                                   transition hover:bg-blue-50"
                                            style="
                                                color: #0B5ED7;
                                                border: 1px solid #D9E7F5;
                                            "
                                        >
                                            <svg
                                                class="w-4 h-4"
                                                fill="none"
                                                stroke="currentColor"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M4 4v5h5M20 20v-5h-5M5.5 9A7 7 0 0117 5.5L20 9M18.5 15A7 7 0 017 18.5L4 15"
                                                />
                                            </svg>

                                            Replace File
                                        </button>

                                    </div>

                                </div>

                            </div>

                        </div>


                        
                        <div
                            class="mt-3 flex flex-col sm:flex-row
                                   sm:items-center sm:justify-between gap-2
                                   text-xs"
                            style="color: #64748B;"
                        >

                            <span class="flex items-center gap-1.5">

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"
                                    />
                                </svg>

                                Supported: XLSX, XLS, CSV
                            </span>

                            <span>
                                Maximum: <strong style="color: #16324F;">100 MB</strong>
                            </span>

                        </div>


                        
                        <div
                            class="mt-4 flex flex-col sm:flex-row sm:items-center
                                   sm:justify-between gap-3 rounded-xl px-4 py-3"
                            style="
                                background: #F3F8FF;
                                border: 1px solid #D9E7F5;
                            "
                        >

                            <div class="flex items-center gap-3">

                                <div
                                    class="w-9 h-9 rounded-lg flex items-center justify-center"
                                    style="background: #FFFFFF;"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="#2F80ED"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M12 16V4m0 0l-4 4m4-4l4 4M4 20h16"
                                        />
                                    </svg>
                                </div>

                                <div>
                                    <p
                                        class="text-sm font-semibold"
                                        style="color: #16324F;"
                                    >
                                        Need a template?
                                    </p>

                                    <p
                                        class="text-xs mt-0.5"
                                        style="color: #64748B;"
                                    >
                                        Use the correct column structure for your customer data.
                                    </p>
                                </div>

                            </div>

                            
                            <span
                                class="text-sm font-semibold whitespace-nowrap"
                                style="color: #0B5ED7;"
                            >
                                Customer Import Template
                            </span>

                        </div>


                        
                        
                        

                        <div class="mt-8 grid grid-cols-1 lg:grid-cols-2 gap-5">


                            
                            <div
                                class="bg-white rounded-2xl border overflow-hidden"
                                style="
                                    border-color: #D9E7F5;
                                    box-shadow: 0 4px 18px rgba(18, 59, 99, 0.03);
                                "
                            >

                                <div
                                    class="px-5 py-4 border-b"
                                    style="border-color: #D9E7F5;"
                                >

                                    <h4
                                        class="font-bold"
                                        style="color: #123B63;"
                                    >
                                        Expected Spreadsheet Columns
                                    </h4>

                                    <p
                                        class="text-xs mt-1"
                                        style="color: #64748B;"
                                    >
                                        The spreadsheet should contain these fields.
                                    </p>

                                </div>


                                <div class="p-5">

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">

                                        
                                        <div
                                            class="rounded-xl p-3"
                                            style="
                                                background: #F7FBFF;
                                                border: 1px solid #D9E7F5;
                                            "
                                        >
                                            <span
                                                class="text-xs font-bold"
                                                style="color: #2F80ED;"
                                            >
                                                01
                                            </span>

                                            <p
                                                class="mt-1 text-sm font-semibold"
                                                style="color: #16324F;"
                                            >
                                                First name
                                            </p>

                                            <span
                                                class="text-xs"
                                                style="color: #64748B;"
                                            >
                                                Required
                                            </span>
                                        </div>


                                        
                                        <div
                                            class="rounded-xl p-3"
                                            style="
                                                background: #F7FBFF;
                                                border: 1px solid #D9E7F5;
                                            "
                                        >
                                            <span
                                                class="text-xs font-bold"
                                                style="color: #2F80ED;"
                                            >
                                                02
                                            </span>

                                            <p
                                                class="mt-1 text-sm font-semibold"
                                                style="color: #16324F;"
                                            >
                                                Second name
                                            </p>

                                            <span
                                                class="text-xs"
                                                style="color: #64748B;"
                                            >
                                                Required
                                            </span>
                                        </div>


                                        
                                        <div
                                            class="rounded-xl p-3"
                                            style="
                                                background: #F7FBFF;
                                                border: 1px solid #D9E7F5;
                                            "
                                        >
                                            <span
                                                class="text-xs font-bold"
                                                style="color: #2F80ED;"
                                            >
                                                03
                                            </span>

                                            <p
                                                class="mt-1 text-sm font-semibold"
                                                style="color: #16324F;"
                                            >
                                                Contact
                                            </p>

                                            <span
                                                class="text-xs"
                                                style="color: #64748B;"
                                            >
                                                Required
                                            </span>
                                        </div>


                                        
                                        <div
                                            class="rounded-xl p-3"
                                            style="
                                                background: #F7FBFF;
                                                border: 1px solid #D9E7F5;
                                            "
                                        >
                                            <span
                                                class="text-xs font-bold"
                                                style="color: #2F80ED;"
                                            >
                                                04
                                            </span>

                                            <p
                                                class="mt-1 text-sm font-semibold"
                                                style="color: #16324F;"
                                            >
                                                Region / Area
                                            </p>

                                            <span
                                                class="text-xs"
                                                style="color: #64748B;"
                                            >
                                                Required
                                            </span>
                                        </div>


                                        
                                        <div
                                            class="rounded-xl p-3"
                                            style="
                                                background: #F7FBFF;
                                                border: 1px solid #D9E7F5;
                                            "
                                        >
                                            <span
                                                class="text-xs font-bold"
                                                style="color: #2F80ED;"
                                            >
                                                05
                                            </span>

                                            <p
                                                class="mt-1 text-sm font-semibold"
                                                style="color: #16324F;"
                                            >
                                                Previous reading
                                            </p>

                                            <span
                                                class="text-xs"
                                                style="color: #64748B;"
                                            >
                                                Required
                                            </span>
                                        </div>


                                        
                                        <div
                                            class="rounded-xl p-3"
                                            style="
                                                background: #F7FBFF;
                                                border: 1px solid #D9E7F5;
                                            "
                                        >
                                            <span
                                                class="text-xs font-bold"
                                                style="color: #2F80ED;"
                                            >
                                                06
                                            </span>

                                            <p
                                                class="mt-1 text-sm font-semibold"
                                                style="color: #16324F;"
                                            >
                                                Acc No / Customer Number
                                            </p>

                                            <span
                                                class="text-xs"
                                                style="color: #64748B;"
                                            >
                                                Required
                                            </span>

                                            <p
                                                class="mt-2 text-xs"
                                                style="color: #64748B;"
                                            >
                                                Example:
                                                <strong style="color: #0B5ED7;">
                                                    M0001 · M0002 · M0009
                                                </strong>
                                            </p>
                                        </div>

                                    </div>

                                </div>

                            </div>


                            
                            <div
                                class="bg-white rounded-2xl border overflow-hidden"
                                style="
                                    border-color: #D9E7F5;
                                    box-shadow: 0 4px 18px rgba(18, 59, 99, 0.03);
                                "
                            >

                                <div
                                    class="px-5 py-4 border-b"
                                    style="border-color: #D9E7F5;"
                                >

                                    <div class="flex items-center gap-3">

                                        <div
                                            class="w-9 h-9 rounded-lg flex items-center justify-center"
                                            style="background: #F3F8FF;"
                                        >
                                            <svg
                                                class="w-5 h-5"
                                                fill="none"
                                                stroke="#0B5ED7"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000 16z"
                                                />
                                            </svg>
                                        </div>

                                        <div>
                                            <h4
                                                class="font-bold"
                                                style="color: #123B63;"
                                            >
                                                How previous readings work
                                            </h4>

                                            <p
                                                class="text-xs mt-1"
                                                style="color: #64748B;"
                                            >
                                                Opening readings are handled automatically.
                                            </p>
                                        </div>

                                    </div>

                                </div>


                                <div class="p-5">

                                    <p
                                        class="text-sm leading-6"
                                        style="color: #64748B;"
                                    >
                                        The spreadsheet's previous reading becomes both the
                                        customer's opening meter reading and current reading.
                                    </p>


                                    
                                    <div class="mt-6 flex items-center justify-center gap-2 sm:gap-3">

                                        <div class="text-center">

                                            <div
                                                class="w-16 h-16 rounded-xl flex items-center justify-center
                                                       text-xl font-bold"
                                                style="
                                                    background: #F3F8FF;
                                                    border: 1px solid #D9E7F5;
                                                    color: #0B5ED7;
                                                "
                                            >
                                                19
                                            </div>

                                            <p
                                                class="text-xs font-medium mt-2"
                                                style="color: #64748B;"
                                            >
                                                Previous
                                            </p>

                                        </div>


                                        <svg
                                            class="w-5 h-5 flex-shrink-0"
                                            fill="none"
                                            stroke="#2F80ED"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 12h14m-5-5l5 5-5 5"
                                            />
                                        </svg>


                                        <div class="text-center">

                                            <div
                                                class="w-16 h-16 rounded-xl flex items-center justify-center
                                                       text-xl font-bold"
                                                style="
                                                    background: #F3F8FF;
                                                    border: 1px solid #D9E7F5;
                                                    color: #0B5ED7;
                                                "
                                            >
                                                19
                                            </div>

                                            <p
                                                class="text-xs font-medium mt-2"
                                                style="color: #64748B;"
                                            >
                                                Opening
                                            </p>

                                        </div>


                                        <svg
                                            class="w-5 h-5 flex-shrink-0"
                                            fill="none"
                                            stroke="#2F80ED"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M5 12h14m-5-5l5 5-5 5"
                                            />
                                        </svg>


                                        <div class="text-center">

                                            <div
                                                class="w-16 h-16 rounded-xl flex items-center justify-center
                                                       text-xl font-bold"
                                                style="
                                                    background: #F3F8FF;
                                                    border: 1px solid #D9E7F5;
                                                    color: #0B5ED7;
                                                "
                                            >
                                                19
                                            </div>

                                            <p
                                                class="text-xs font-medium mt-2"
                                                style="color: #64748B;"
                                            >
                                                Current
                                            </p>

                                        </div>

                                    </div>


                                    
                                    <div
                                        class="mt-6 rounded-xl p-4"
                                        style="
                                            background: #F3F8FF;
                                            border: 1px solid #D9E7F5;
                                        "
                                    >

                                        <div class="flex items-start gap-3">

                                            <svg
                                                class="w-5 h-5 flex-shrink-0 mt-0.5"
                                                fill="none"
                                                stroke="#0B5ED7"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M13 16h-1v-4h-1m1-4h.01M12 20a8 8 0 100-16 8 8 0 000-16z"
                                                />
                                            </svg>

                                            <p
                                                class="text-sm leading-5"
                                                style="color: #16324F;"
                                            >
                                                No historical meter-reading transaction is created.
                                                Future readings will calculate consumption normally.
                                            </p>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>


                        
                        
                        

                        <div
                            class="mt-5 rounded-2xl p-5"
                            style="
                                background: #F3F8FF;
                                border: 1px solid #D9E7F5;
                            "
                        >

                            <div class="flex items-start gap-3">

                                <div
                                    class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                                    style="background: #FFFFFF;"
                                >
                                    <svg
                                        class="w-5 h-5"
                                        fill="none"
                                        stroke="#16A34A"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M5 13l4 4L19 7"
                                        />
                                    </svg>
                                </div>


                                <div>

                                    <h4
                                        class="font-bold"
                                        style="color: #16324F;"
                                    >
                                        Nothing will be imported yet
                                    </h4>

                                    <p
                                        class="text-sm mt-1 leading-6"
                                        style="color: #64748B;"
                                    >
                                        <strong style="color: #16324F;">
                                            Analyze Spreadsheet
                                        </strong>
                                        only reads and validates your file.
                                        You'll review duplicates, errors and valid records
                                        before confirming the actual import.
                                    </p>

                                </div>

                            </div>

                        </div>


                        
                        
                        

                        <div
                            class="mt-8 pt-6 border-t flex flex-col-reverse
                                   sm:flex-row sm:items-center sm:justify-between gap-3"
                            style="border-color: #D9E7F5;"
                        >

                            <a
                                href="<?php echo e(route('customers.index')); ?>"
                                class="inline-flex items-center justify-center
                                       px-5 py-2.5 rounded-xl text-sm font-semibold
                                       transition hover:bg-gray-50"
                                style="
                                    color: #64748B;
                                    border: 1px solid #D9E7F5;
                                    background: #FFFFFF;
                                "
                            >
                                Cancel
                            </a>


                            <button
                                id="submitButton"
                                type="submit"
                                class="inline-flex items-center justify-center gap-2
                                       px-6 py-3 rounded-xl text-sm font-semibold
                                       text-white transition shadow-sm"
                                style="background: #0B5ED7;"
                                onmouseover="this.style.background='#084DAF'"
                                onmouseout="this.style.background='#0B5ED7'"
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
                                        d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h10a2 2 0 012 2v12a2 2 0 01-2 2z"
                                    />
                                </svg>

                                <span id="submitText">
                                    Analyze Spreadsheet
                                </span>

                                <svg
                                    class="w-4 h-4"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M5 12h14m-5-5l5 5-5 5"
                                    />
                                </svg>

                            </button>

                        </div>

                    </form>

                </div>

            </div>


            
            
            

            <div class="mt-8">

                <div class="mb-4">

                    <h3
                        class="text-lg font-bold"
                        style="color: #123B63;"
                    >
                        Import Process
                    </h3>

                    <p
                        class="text-sm mt-1"
                        style="color: #64748B;"
                    >
                        Your customer data passes through three simple steps.
                    </p>

                </div>


                <div
                    class="bg-white rounded-2xl border p-6"
                    style="
                        border-color: #D9E7F5;
                        box-shadow: 0 4px 18px rgba(18, 59, 99, 0.03);
                    "
                >

                    <div class="relative">

                        
                        <div
                            class="hidden md:block absolute top-5 left-[16%] right-[16%] h-px"
                            style="background: #D9E7F5;"
                        ></div>


                        <div class="relative grid grid-cols-1 md:grid-cols-3 gap-6">


                            
                            <div class="text-center">

                                <div
                                    class="mx-auto w-11 h-11 rounded-full flex items-center
                                           justify-center font-bold text-sm text-white relative z-10"
                                    style="background: #0B5ED7;"
                                >
                                    01
                                </div>

                                <h4
                                    class="mt-3 font-bold"
                                    style="color: #16324F;"
                                >
                                    Upload
                                </h4>

                                <p
                                    class="text-xs mt-1"
                                    style="color: #64748B;"
                                >
                                    Select your spreadsheet
                                </p>

                            </div>


                            
                            <div class="text-center">

                                <div
                                    class="mx-auto w-11 h-11 rounded-full flex items-center
                                           justify-center font-bold text-sm relative z-10"
                                    style="
                                        background: #FFFFFF;
                                        color: #64748B;
                                        border: 1px solid #D9E7F5;
                                    "
                                >
                                    02
                                </div>

                                <h4
                                    class="mt-3 font-bold"
                                    style="color: #16324F;"
                                >
                                    Review
                                </h4>

                                <p
                                    class="text-xs mt-1"
                                    style="color: #64748B;"
                                >
                                    Check the import preview
                                </p>

                            </div>


                            
                            <div class="text-center">

                                <div
                                    class="mx-auto w-11 h-11 rounded-full flex items-center
                                           justify-center font-bold text-sm relative z-10"
                                    style="
                                        background: #FFFFFF;
                                        color: #64748B;
                                        border: 1px solid #D9E7F5;
                                    "
                                >
                                    03
                                </div>

                                <h4
                                    class="mt-3 font-bold"
                                    style="color: #16324F;"
                                >
                                    Confirm
                                </h4>

                                <p
                                    class="text-xs mt-1"
                                    style="color: #64748B;"
                                >
                                    Add customers to the system
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    
    
    

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const fileInput = document.getElementById('file');
            const dropZone = document.getElementById('dropZone');
            const emptyState = document.getElementById('emptyState');
            const selectedState = document.getElementById('selectedState');

            const fileName = document.getElementById('fileName');
            const fileDetails = document.getElementById('fileDetails');

            const replaceFile = document.getElementById('replaceFile');

            const form = document.getElementById('customerImportForm');
            const submitButton = document.getElementById('submitButton');
            const submitText = document.getElementById('submitText');


            function formatFileSize(bytes) {

                if (bytes < 1024) {
                    return bytes + ' B';
                }

                if (bytes < 1024 * 1024) {
                    return (bytes / 1024).toFixed(1) + ' KB';
                }

                return (bytes / (1024 * 1024)).toFixed(2) + ' MB';
            }


            function getFileExtension(name) {

                return name.split('.').pop().toUpperCase();

            }


            function displaySelectedFile(file) {

                if (!file) {
                    emptyState.classList.remove('hidden');
                    selectedState.classList.add('hidden');
                    return;
                }


                fileName.textContent = file.name;

                fileDetails.textContent =
                    getFileExtension(file.name) +
                    ' • Ready to analyze • ' +
                    formatFileSize(file.size);


                emptyState.classList.add('hidden');
                selectedState.classList.remove('hidden');


                dropZone.style.background = '#EAF4FF';
                dropZone.style.borderColor = '#2F80ED';

            }


            fileInput.addEventListener('change', function () {

                if (this.files && this.files.length > 0) {

                    displaySelectedFile(this.files[0]);

                }

            });


            replaceFile.addEventListener('click', function (event) {

                event.preventDefault();
                event.stopPropagation();

                fileInput.value = '';

                emptyState.classList.remove('hidden');
                selectedState.classList.add('hidden');

                dropZone.style.background = '#F7FBFF';
                dropZone.style.borderColor = '#B8D4F2';

                fileInput.click();

            });


            ['dragenter', 'dragover'].forEach(function (eventName) {

                dropZone.addEventListener(eventName, function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    dropZone.style.background = '#EAF4FF';
                    dropZone.style.borderColor = '#2F80ED';

                });

            });


            ['dragleave', 'drop'].forEach(function (eventName) {

                dropZone.addEventListener(eventName, function (event) {

                    event.preventDefault();
                    event.stopPropagation();

                    if (!fileInput.files || fileInput.files.length === 0) {

                        dropZone.style.background = '#F7FBFF';
                        dropZone.style.borderColor = '#B8D4F2';

                    }

                });

            });


            dropZone.addEventListener('drop', function (event) {

                const files = event.dataTransfer.files;

                if (files.length > 0) {

                    fileInput.files = files;

                    displaySelectedFile(files[0]);

                }

            });


            form.addEventListener('submit', function () {

                if (!fileInput.files.length) {
                    return;
                }


                submitButton.disabled = true;

                submitButton.style.opacity = '0.75';
                submitButton.style.cursor = 'not-allowed';

                submitText.textContent = 'Analyzing...';

            });

        });
    </script>

 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH C:\Users\ADMIN\Downloads\maji-mazuri-deploy\resources\views\customers\import.blade.php ENDPATH**/ ?>