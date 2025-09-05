<div {{ $attributes->merge(["class" => $class]) }}>
    @if (! is_null($content))
        {!! \Illuminate\Support\Str::markdown($content, $options) !!}
    @else
        {!! \Illuminate\Support\Str::markdown(trim($slot), $options) !!}
    @endif
</div>
