<?php

use Illuminate\Support\Str;

if (! function_exists('render_markdown')) {
    /**
     * render text markdown
     */
    function render_markdown(?string $input): ?string
    {
        return Str::markdown($input);
    }
}

if (! function_exists('new_ulid')) {
    /**
     * custom function for generate ulid from any where
     */
    function new_ulid(): string
    {
        return strtolower((string) Str::ulid());
    }
}
