@props([
    'title',
    'content',
    'footer'
])

<div>
    <div class="bg-white max-w-xs shadow-lg mx-auto border-b-4 border-indigo-500
                            rounded-2xl overflow-hidden">
        <div class="flex h-10  items-center border-b-2 border-indigo-500">
            <p class="ml-4 font-semibold uppercase text-indigo-500">
                {{ $title }}
            </p>
        </div>
        <p class="py-6 px-4 text-lg tracking-wide">
            {{ $content }}
        </p>
        <div class="flex justify-start px-4 text-sm mb-4">
            {{ $footer }}
        </div>
    </div>
</div>
