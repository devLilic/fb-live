<x-app-layout>
    <x-main-content>
        <div class="bg-white w-full rounded-lg">
            <div class="relative flex flex-col items-center my-6">

                @include('blocks.schedule-table')

            </div>
        </div>
        <a href="{{ route('schedule.create') }}" class="block h-12 w-12 text-white bg-blue-300 hover:bg-blue-400 text-center rounded-full font-bold text-4xl fixed bottom-10 right-10"><span class="w-5 h-5">+</span></a>
    </x-main-content>
</x-app-layout>
