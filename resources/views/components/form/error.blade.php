@props(['name'])
@aware(['message'])

@error($name)
    <p class="px-3 py-1 text-sm border bg-red-200 text-red-700 my-1 rounded">{{ $message }}</p>
@enderror
