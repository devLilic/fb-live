<div class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
    <div class="flex items-center mt-5 mb-3 space-x-4">
        {{ $slot }}
    </div>
    <div class="flex items-center">
        <button type='button' class="font-semibold text-red-600">Cancel</button>
        <x-form.button class="ml-2">Save</x-form.button>
    </div>
</div>
