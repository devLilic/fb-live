@props([
'name',
'id',
'value'=>'',
'checked' => 0
])

@php
    $value = $value ?? $name;
@endphp

<label class="inline-flex items-center justify-between font-semibold text-blue-400 mx-3 my-2" for="{{$id}}">
    <input
        class="rounded-full mr-2"
        type="checkbox"
        name="{{$name}}"
        id="{{$id}}"
        value="{{ $value }}"

        {{ $checked ? 'checked' : '' }}

        {{ $attributes }}
    />
    {{ $slot }}
</label>
