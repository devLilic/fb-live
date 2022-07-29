<x-app-layout>
    <x-main-content>

        <div class="bg-white w-full rounded-lg">
            <div class="px-4 py-3 flex items-start flex-col lg:flex-row justify-between">
                <div class="w-full lg:mr-4 mb-4">
                    <livewire:live-preview/>
                    <livewire:new-live-form/>
                </div>
                <div class="sm:w-full">
                    <livewire:live-starter/>
                </div>
            </div>
        </div>
    </x-main-content>
</x-app-layout>
