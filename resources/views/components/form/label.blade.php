@props([
'for',
'value'
])

<label for="{{ $for }}" value="{{ $value }}">
    {{ $slot }}
</label>
