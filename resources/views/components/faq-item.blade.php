@props([
    "id",
    "question",
    "expanded" => false,
    "count" => 0,
])

@php
    $buttonId = "accordion-heading-{$id}";
    $bodyId = "accordion-body-{$id}";
@endphp

<div class="isolate">
    <h2 id="{{ $buttonId }}">
        <div
            class="flex w-full items-center justify-between gap-3 rounded-xl border border-gray-200 p-5 font-medium text-gray-500 hover:bg-gray-100 dark:border-gray-500 dark:text-gray-400 dark:hover:bg-gray-900"
            data-accordion-target="#{{ $bodyId }}"
            aria-expanded="{{ $expanded ? "true" : "false" }}"
            aria-controls="{{ $bodyId }}"
        >
            <span
                class="me-2 rounded-sm bg-red-100 px-2.5 py-0.5 text-xs font-medium text-red-800 dark:bg-red-900 dark:text-red-300"
            >
                {{ $count }}
            </span>
            <span class="flex-1 text-left">{{ $question }}</span>
            <svg
                data-accordion-icon
                class="{{ $expanded ? "" : "rotate-180" }} h-3 w-3 shrink-0"
                aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg"
                fill="none"
                viewBox="0 0 10 6"
            >
                <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5 5 1 1 5"
                />
            </svg>
        </div>
    </h2>
    <div
        id="{{ $bodyId }}"
        class="{{ $expanded ? "" : "hidden" }} relative z-0"
        aria-labelledby="{{ $buttonId }}"
    >
        <div
            class="mt-1 rounded-xl border border-gray-200 bg-gray-50 p-5 dark:border-gray-700 dark:bg-gray-600"
        >
            {{ $slot }}
        </div>
    </div>
</div>
