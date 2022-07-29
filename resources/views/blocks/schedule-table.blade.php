<x-table class="border mx-2 my-2">

    <x-slot name="header">
        <x-table.header-cell>Titlu</x-table.header-cell>
        <x-table.header-cell>Program</x-table.header-cell>
        <x-table.header-cell>Durata</x-table.header-cell>
        <x-table.header-cell>Status</x-table.header-cell>
        <x-table.header-cell>
            &nbsp;
        </x-table.header-cell>
    </x-slot>

    @foreach($pagesSchedules as $item)
        <tr>
            <x-table.cell>
                <x-table.title-cell title="{{ $item->title }}"/>
            </x-table.cell>

            <x-table.cell>
                <div class="text-sm text-gray-900">
                    @php
                        $daysOfWeek = [ 'L', 'M', 'Mi', 'J', 'V', 'S', 'D' ];
                    @endphp
                    @foreach(str_split($item->days) as $day)
                        {{ $daysOfWeek[$day-1] }}{{ !$loop->last ? ', ': ''}}
                    @endforeach
                </div>
                <div class="text-sm text-gray-500">{{ $item->start_time }}</div>
            </x-table.cell>

            <x-table.cell class=" text-sm text-gray-500">
                {{ $item->duration }} min.
            </x-table.cell>

            <x-table.cell>
                <x-table.status-cell status="{{ $item->disabled }}"/>
            </x-table.cell>

            <x-table.cell class="text-sm font-medium">
                <x-navigation.link href="{{ route('schedule.edit', $item->id) }}"
                                   class="text-indigo-600 hover:text-indigo-900 flex items-center"
                >Edit</x-navigation.link>
            </x-table.cell>
        </tr>
    @endforeach
</x-table>
