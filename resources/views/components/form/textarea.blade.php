@props(['name'])

<div class="flex flex-col mb-4">
    <label class="mb-2 font-bold text-lg text-gray-900" for="{{ $name }}">{{ ucwords($name) }}</label>
    <textarea name="{{$name}}"
              {{ $attributes->merge(['class' => "border py-2 px-3 text-grey-800"]) }}
              ></textarea>
    <x-form.error name="{{ $name }}" />
</div>
