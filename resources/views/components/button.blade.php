@props([
    "variant" => "primary",
    "value",
])

@php
    $baseClasses = "inline-flex items-center rounded-md border border-transparent p-2.5 text-xs font-semibold tracking-widest uppercase transition duration-150 ease-in-out focus:ring-2 focus:ring-offset-2 focus:outline-hidden";

    $variantClasses = match ($variant) {
        "gray" => "bg-gray-100 text-gray-800 hover:bg-gray-100 focus:ring-gray-500 active:bg-gray-200 dark:bg-gray-800 dark:text-gray-200 dark:hover:bg-gray-700 dark:focus:ring-offset-gray-800 dark:active:bg-gray-900",
        "info" => "bg-green-400 text-white hover:bg-green-600 focus:ring-green-500 active:bg-green-700 dark:bg-green-600 dark:hover:bg-green-500 dark:focus:ring-offset-green-800 dark:active:bg-green-700",
        "danger" => "bg-red-400 text-white hover:bg-red-700 focus:ring-red-500 active:bg-red-800 dark:bg-red-200 dark:hover:bg-red-600 dark:focus:ring-offset-red-800 dark:active:bg-red-800",
        default => "bg-blue-400 text-white hover:bg-blue-700 focus:ring-blue-500 active:bg-blue-900 dark:bg-blue-200 dark:text-blue-800 dark:hover:bg-white dark:focus:ring-offset-blue-800 dark:active:bg-blue-300",
    };
    $finalClasses = $baseClasses . " " . $variantClasses;
@endphp

<button
    {{ $attributes->merge(["type" => "submit", "class" => $finalClasses]) }}
>
    {{ $value ?? $slot }}
</button>
