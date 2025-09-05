<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Markdown extends Component
{
    /**
     * Konten markdown.
     */
    public ?string $content;

    /**
     * Kelas tambahan untuk wrapper.
     */
    public string $class;

    /**
     * Opsi parsing markdown.
     */
    public array $options;

    /**
     * Buat instance komponen.
     */
    public function __construct(
        ?string $content = '',
        string $class = 'prose max-w-none dark:prose-invert',
        array $options = []
    ) {
        $this->content = $content;
        $this->class = $class;
        $this->options = array_merge([
            'html_input' => 'strip',       // strip | allow | escape
            'allow_unsafe_links' => false,
        ], $options);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.markdown');
    }
}
