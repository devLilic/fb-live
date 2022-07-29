<x-app-layout>
    <x-main-content>

        <div class="bg-white w-full rounded-lg mx-5 p-2">

            <h1 class="text-2xl font-bold">Rooms of {{ auth()->user()->name }}</h1>

            @foreach ($rooms as $room)
                <a href="{{ route('rooms.show', ['room'=>$room->id]) }}">{{ $room->title }}</a>
            @endforeach
        </div>
    </x-main-content>
</x-app-layout>

