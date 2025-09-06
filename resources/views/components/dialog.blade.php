@props([
    "name",
    "show" => false,
    "maxWidth" => "2xl",
])

@php
    $maxWidthClass = [
        "sm" => "sm:max-w-sm",
        "md" => "sm:max-w-md",
        "lg" => "sm:max-w-lg",
        "xl" => "sm:max-w-xl",
        "2xl" => "sm:max-w-2xl",
    ][$maxWidth];
@endphp

<div
    x-data="{ show: @js($show) }"
    x-ref="dialog"
    x-init="
        if (show) $refs.dialog.showModal()
        $watch('show', (value) =>
            value ? $refs.dialog.showModal() : $refs.dialog.close(),
        )
    "
    x-on:open-dialog.window="$event.detail === '{{ $name }}' ? (show = true) : null"
    x-on:close-dialog.window="$event.detail === '{{ $name }}' ? (show = false) : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    class="z-[100] border-0 bg-transparent p-0 backdrop-blur-sm backdrop:bg-black/60 dark:backdrop:bg-gray-900/70"
>
    <div
        class="{{ $maxWidthClass }} relative mx-2 w-full overflow-hidden rounded-lg bg-white shadow-xl md:mx-auto dark:bg-gray-700"
        @click.outside="show = false"
    >
        {{ $slot }}
    </div>
</div>
