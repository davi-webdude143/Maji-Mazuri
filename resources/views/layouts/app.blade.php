<!DOCTYPE html>
<html
    lang="{{ str_replace('_', '-', app()->getLocale()) }}"
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
        content="{{ csrf_token() }}"
    >

    <title>
        @hasSection('title')
            @yield('title') -
        @endif
        {{ config('app.name', 'Pure Tide Mazuri Ltd') }}
    </title>


    {{-- =========================================================
         PREVENT LIGHT-MODE FLASH
    ========================================================== --}}

    <script>
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark');
        }
    </script>


    {{-- =========================================================
         FONTS
    ========================================================== --}}

    <link rel="preconnect" href="https://fonts.bunny.net">

    <link
        href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap"
        rel="stylesheet"
    >


    {{-- =========================================================
         APPLICATION ASSETS
    ========================================================== --}}

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

    @stack('styles')

</head>


<body class="font-sans antialiased">

    <div class="min-h-screen bg-gray-100 dark:bg-gray-950 transition-colors duration-300">

        {{-- =====================================================
             NAVIGATION
        ====================================================== --}}

        <livewire:layout.navigation />


        {{-- =====================================================
             MAIN APPLICATION AREA
        ====================================================== --}}

        <main class="lg:ml-64 pt-16 lg:pt-0 min-h-screen">

            {{-- =================================================
                 OPTIONAL PAGE HEADER
            ================================================== --}}

            @isset($header)

                <header
                    class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800"
                >
                    <div
                        class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8"
                    >
                        {{ $header }}
                    </div>
                </header>

            @endisset


            {{-- =================================================
                 PAGE CONTENT
            ================================================== --}}

            @isset($slot)

                {{-- Component-style layouts --}}
                {{ $slot }}

            @else

                {{-- Traditional @extends / @section layouts --}}
                @yield('content')

            @endisset

        </main>

    </div>


    {{-- =========================================================
         STACKED SCRIPTS
    ========================================================== --}}

    @stack('scripts')

</body>

</html>