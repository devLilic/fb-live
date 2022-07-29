@props([
    'name',
    'placeholder',
    'id' => '',
    'type' => 'text',
])
@php
@endphp
<div class="flex flex-col w-full">
    <input {{ $attributes->merge(['class' => "block text-grey-800 rounded"]) }}
        name="{{ $name }}"
        placeholder="{{ ucwords($placeholder ?? $name) }}"
        type="{{ $type }}"
        id="{{ !empty($id) ? $id : $name }}"
    >

    <x-form.error name="{{ $name }}" />
</div>

