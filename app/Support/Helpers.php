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
