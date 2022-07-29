@props(['name'])

<div class="mb-3 w-full">
    <select
        {{ $attributes->merge([
            'class' => "py-2 px-3 bg-white border border-gray-500 rounded"
        ]) }}
        id="{{ $name }}"
        name="{{ $name }}"
    >
        {{ $slot }}
    </select>
</div>
