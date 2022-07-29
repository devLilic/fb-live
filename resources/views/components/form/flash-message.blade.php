@props([
'type' => 'success',
])

@php
    $color = ($type === 'error') ? 'red': 'green'
@endphp

<div {{ $attributes->merge([
        'class' => "text-xs text-white px-3 py-2 flex justify-between items-center mt-3 rounded text-{$color}-700 bg-{$color}-100"
    ]) }} >
    {{ $slot }}
    <span {{ $attributes->merge([
            'class' => "px-2 py-1 cursor-pointer border rounded ml-3 text-{$color}-700 bg-{$color}-200 hover:bg-{$color}-300 border-{$color}-400",
        ]) }}
    >x</span>
</div>
