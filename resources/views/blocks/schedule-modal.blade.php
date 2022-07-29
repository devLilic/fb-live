<x-modal>
    <x-slot name="modal_title">New Schedule</x-slot>

    <div class="flex flex-col px-6 py-5 bg-gray-50">
        <div class="flex flex-col sm:flex-row items-center sm:space-x-5">
            <span class="w-1/2">
                <x-form.input class='w-full' name="title"/>
            </span>
            <span class="w-1/2">
            <x-form.select name="pages">
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
                    <x-form.input class="w-1/2 text-center" name="time" placeholder="00:00"/>
                </div>
                <div>
                    <p class="mb-2 font-semibold text-gray-700">Duration</p>
                    <x-form.input class="w-1/2 text-center" name="duration" placeholder="minute"/>
                </div>
            </div>
            <div class="flex items-start mt-5 mb-3 justify-between w-1/3 space-x-4 text-left">
                <div class="flex flex-col">
                    <x-form.checkbox value="1" name="days[]" id="day-1" text="Monday"/>
                    <x-form.checkbox value="2" name="days[]" id="day-2" text="Tuesday"/>
                    <x-form.checkbox value="3" name="days[]" id="day-3" text="Wednesday"/>
                    <x-form.checkbox value="4" name="days[]" id="day-4" text="Thursday"/>
                </div>
                <div class="flex flex-col">
                    <x-form.checkbox value="5" name="days[]" id="day-5" text="Friday"/>
                    <x-form.checkbox value="6" name="days[]" id="day-6" text="Saturday"/>
                    <x-form.checkbox value="7" name="days[]" id="day-7" text="Sunday"/>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="modal_footer">
        <x-form.checkbox value="disabled" id="disabled" name="disabed" text="Disable"></x-form.checkbox>
    </x-slot>
</x-modal>
