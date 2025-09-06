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
    x-data="{
        show: @js($show),
        focusables() {
            let selector = 'a, button, input:not([type=\'hidden\']), textarea, select, details, [tabindex]:not([tabindex=\'-1\'])';
            return [...$el.querySelectorAll(selector)].filter(el => !el.hasAttribute('disabled'));
        },
        firstFocusable() { return this.focusables()[0] },
        lastFocusable() { return this.focusables().slice(-1)[0] },
        nextFocusable() {
            return this.focusables()[this.nextFocusableIndex()] || this.firstFocusable()
        },
        prevFocusable() {
            return this.focusables()[this.prevFocusableIndex()] || this.lastFocusable()
        },
        nextFocusableIndex() {
            return (this.focusables().indexOf(document.activeElement) + 1) % this.focusables().length
        },
        prevFocusableIndex() {
            return Math.max(0, this.focusables().indexOf(document.activeElement) - 1)
        },
    }"
    x-init="
        $watch('show', (value) => {
            document.body.classList.toggle('overflow-y-hidden', value)
            {{ $attributes->has("focusable") ? "setTimeout(() => firstFocusable()?.focus(), 100)" : "" }}
        })
    "
    x-show="show"
    x-on:open-modal.window="$event.detail === '{{ $name }}' ? (show = true) : null"
    x-on:close-modal.window="$event.detail === '{{ $name }}' ? (show = false) : null"
    x-on:close.stop="show = false"
    x-on:keydown.escape.window="show = false"
    x-on:keydown.tab.prevent="$event.shiftKey ? prevFocusable().focus() : nextFocusable().focus()"
    class="fixed inset-0 z-[100] overflow-y-auto sm:px-0"
    style="display: none"
>
    <!-- Wrapper: menangkap klik di luar modal -->
    <div
        x-show="show"
        class="fixed inset-0 z-[100] flex items-center justify-center"
        x-on:click="show = false"
        x-transition:enter="duration-300 ease-out"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="duration-200 ease-in"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
    >
        <!-- Overlay -->
        <div
            class="absolute inset-0 bg-black/60 backdrop-blur-sm dark:bg-gray-900/70"
        ></div>

        <!-- Modal Content -->
        <div
            class="{{ $maxWidthClass }} relative z-[110] mx-2 w-full overflow-hidden rounded-lg bg-white shadow-xl md:mx-auto dark:bg-gray-700"
            @click.stop
        >
            {{ $slot }}
        </div>
    </div>
</div>
