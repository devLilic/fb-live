<x-app-layout>
    <x-main-content>
        <div class="bg-white w-full rounded-lg">
            <div class="relative flex flex-col items-center my-6">
                <x-form action="{{ route('schedule.update', $schedule->id) }}" method="patch">
                    <div class="flex flex-col px-6 py-5 bg-gray-50 border border-gray-300 rounded-lg shadow">
                        <div class="flex flex-col sm:flex-row items-center sm:space-x-5">
                            <span class="w-1/2">
                                <x-form.input class='w-full' name="title" value="{{ old('title') ?? $schedule->title }}"/>
                            </span>
                            <span class="w-1/2">
                                <x-form.select name="page">
                                    @foreach($pages as $page)
                                        <option value="{{ $page->id }}">{{ $page->page_title }}</option>
                                    @endforeach
                                </x-form.select>
                            </span>
                        </div>
                        <hr/>
                        <div class="flex items-center">
                            <div class="flex w-1/2">
                                <div>
                                    <p class="mb-2 font-semibold text-gray-700">Start</p>
                                    <x-form.input class="w-1/2 text-center" name="time" placeholder="00:00" value="{{ old('time') ?? $schedule->start_time }}"/>
                                </div>
                                <div>
                                    <p class="mb-2 font-semibold text-gray-700">Duration</p>
                                    <x-form.input class="w-1/2 text-center" name="duration" placeholder="minute" value="{{ old('duration') ?? $schedule->duration }}"/>
                                </div>
                            </div>
                            <div class="flex items-center justify-between w-1/2 ml-5 text-left">
                                <div class="flex flex-row flex-wrap">
                                    @php
                                        $weekDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                                        $days = old('days') ?? str_split($schedule->days);
                                    @endphp
                                    @foreach($weekDays as $weekDay)
                                        <x-form.checkbox
                                            value="{{ $loop->iteration }}"
                                            name="days[]"
                                            id="day-{{ $loop->iteration }}"
                                            checked="{{ in_array($loop->iteration, $days) }}"
                                        >{{ $weekDay }}</x-form.checkbox>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                         <div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 -mx-6 -mb-5 rounded-lg">
                            <div class="flex items-center mt-5 mb-3 space-x-4">
                                <x-form.checkbox id="disabled" value="disabled" checked="{{ $schedule->disabled }}" name="disabled">Disable</x-form.checkbox>
                            </div>
                            <div class="flex items-center">

                                <x-form.button class="ml-2">Save</x-form.button>
                            </div>
                        </div>
                    </div>
                </x-form>
                <x-form method="delete" action="{{ route('schedule.destroy', $schedule->id) }}" class="flex flex-col items-start">
                    <x-form.button type="submit"
                                   class="text-red-600 hover:text-red-900 justify-between ml-5 items-center"
                                   color="transparent"
                    >Delete</x-form.button>
                </x-form>
            </div>
        </div>
    </x-main-content>
</x-app-layout>
