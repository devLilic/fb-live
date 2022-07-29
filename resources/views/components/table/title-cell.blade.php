@props(['title'])
<div class="flex items-center">
    <div class="flex-shrink-0 h-10 w-10 hidden sm:block">
        <div
            class="flex items-center justify-center text-green-700 text-center font-bold h-10 w-10 rounded-full text-3xl bg-green-200"
        >{{strtoupper($title[0])}}</div>
    </div>
    <div>
        <div class="text-sm font-medium text-gray-900 sm:ml-3">
            {{ $title }}
        </div>
    </div>
</div>

