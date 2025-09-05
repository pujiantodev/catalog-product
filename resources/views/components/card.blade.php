<div
    {{ $attributes->merge(["class" => "overflow-hidden bg-white p-6 text-gray-900 shadow-xs sm:rounded-lg dark:bg-gray-800 dark:text-gray-200"]) }}
>
    {{ $slot }}
</div>
