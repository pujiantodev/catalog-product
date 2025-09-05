<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>
            @if (isset($title)) {{ $title }} -
            {{ config("app.name", "Laravel") }} 
            @else
            {{ config("app.name", "Laravel") }} @endif
        </title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
            rel="stylesheet"
        />

        <!-- Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
        @stack("styles")
    </head>
    <body class="font-sans antialiased">
        <x-flash-status :status="session('status')" />
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include("layouts.navigation")

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow-sm dark:bg-gray-800">
                    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
        @stack("scripts")
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
        @production
            <script src="https://unpkg.com/lucide@latest"></script>
        @else
            <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
        @endproduction

        <script>
            lucide.createIcons();
        </script>
    </body>
</html>
