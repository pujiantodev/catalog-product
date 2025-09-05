@props(["disabled" => false])

<input
    @disabled($disabled)
    {{ $attributes->merge(["class" => "block w-full rounded-lg bg-white px-3 py-2.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-primary-600 sm:text-sm/6 dark:bg-gray-800 dark:text-gray-200 dark:outline-gray-500"]) }}
/>
