<x-table class="border sm:w-full">

    <x-slot name="header">
        <x-table.header-cell>Titlu</x-table.header-cell>
        <x-table.header-cell>Ora start</x-table.header-cell>
        <x-table.header-cell>Durata</x-table.header-cell>
    </x-slot>

    @foreach($schedules as $item)
        <tr>
            <x-table.cell>
                <x-table.title-cell title="{{ $item->title }}"/>
            </x-table.cell>

            <x-table.cell>
                <div class="text-sm text-gray-500">{{ $item->start_time }}</div>
            </x-table.cell>

            <x-table.cell class=" text-sm text-gray-500">
                {{ $item->duration }} min.
            </x-table.cell>
        </tr>
    @endforeach
</x-table>
