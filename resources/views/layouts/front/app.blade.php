<!DOCTYPE html>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <title>
            {{ config("app.name") ?? "Laravel Flowbite Starter Kit" }}
        </title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net" />
        <link
            href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600"
            rel="stylesheet"
        />

        <!-- Styles / Scripts -->
        @vite(["resources/css/app.css", "resources/js/app.js"])
    </head>
    <body
        class="min-h-screen bg-gray-200 font-sans antialiased dark:bg-gray-700"
    >
        @include("layouts.front.header")
        <main class="pt-20 md:pt-28">
            <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
                {{ $slot }}
            </div>
        </main>
        <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    </body>
</html>
