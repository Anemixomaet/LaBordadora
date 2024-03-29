<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="shortcut icon" href="/imagen/pelota.png" />
        
        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script src="{{ asset('js/alpine.js') }}" defer></script>
        <script src="{{ asset('js/apexcharts.min.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <!-- <main style="background-color: lightblue;"> -->
            <main style="background-image: url('{{ asset('imagen/fondo.jpg') }}'); background-size: cover; background-position: center center; height: 100vh; display: flex; align-items: center; justify-content: center;">
                {{ $slot }}
            </main>
        </div>

        @stack('modals')
        @stack('scripts')

        @livewireScripts
        @livewireChartsScripts
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
        <script src="{{ asset('js/alpine.min.js') }}" crossorigin="anonymous"></script>
        <script src="{{ asset('js/apexcharts.min.js') }}" crossorigin="anonymous"></script>
    </body>
</html>
