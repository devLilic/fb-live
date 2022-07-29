@props([
'type' => 'submit',
'color' => 'indigo'
])

@php
    $css = 'px-4 py-2 select-none focus:outline-none focus:shadow-outline '.
            (($color === 'transparent') ?
            'bg-transparent text-gray-700' :
            "bg-{$color}-600 border-{$color}-500 hover:bg-{$color}-700 border text-white rounded-md ");
@endphp
<button type="{{$type}}"
    {{ $attributes->merge([
        'class' => $css
    ]) }}>
    {{ $slot }}
</button>

