<x-app-layout>
    <x-main-content>

        <div class="bg-white w-full rounded-lg mx-5 p-2">
            <h2>{{ $room->title }}</h2>
            <p>Owner: {{ $room->owner->name }}</p>
        </div>
    </x-main-content>
</x-app-layout>

