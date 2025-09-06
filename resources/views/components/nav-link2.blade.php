@props([
    "href" => "#",
    "active" => false,
])

@php
    $baseClasses = "group flex items-center rounded-lg p-2 transition-colors";
    $activeClasses =
        "bg-primary-200 font-semibold text-primary-600 dark:bg-primary-700 dark:text-primary-200";
    $inactiveClasses =
        "text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700";
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(["class" => $baseClasses . " " . ($active ? $activeClasses : $inactiveClasses)]) }}
>
    <span class="ms-3">{{ $slot }}</span>
</a>
