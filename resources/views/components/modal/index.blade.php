<!--Modal-->
<div class="h-screen bg-blue-200 w-full bg-opacity-25 absolute top-0 left-0">
    <div class="w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl mt-20">
        <div class="bg-white border-b border-gray-200 rounded-lg">
            <x-form action="#" {{ $attributes }}>

                <x-modal.header>
                    {{ $modal_title }}
                </x-modal.header>

                {{ $slot }}

                <x-modal.footer>
                    {{ $modal_footer }}
                </x-modal.footer>

            </x-form>
        </div>
    </div>
</div>
<!--End Modal-->
