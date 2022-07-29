<div class="w-full">
    <form wire:submit.prevent="{{ $isLive ? 'stopLive' : 'startLive' }}" class="flex items-center justify-between">
        <x-form.input name="title" placeholder="Title to display on Facebook" wire:model.defer="title" class="py-2" required autofocus/>
        <div>
            <x-form.button class="whitespace-nowrap ml-2 inline-flex items-center" color="{{$isLive ? 'red':'indigo'}}">
                <svg wire:loading class= "animate-spin -ml-1 mr-2 m-3r h-5 w-5 text-white"
                     xmlns="http://www.w3.org/2000/svg"
                     fill="none"
                     viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor"
                          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>{{$isLive? 'Stop ' : 'Start '}} Live</span>
            </x-form.button>
        </div>
    </form>
    <x-form.input name="FB-key" id="FB-key" wire:model="streamKey" class="mt-2 w-1/2"/>
    <script type="text/javascript">
        let set = 0;
        document.addEventListener('DOMContentLoaded', ()=>{
            Livewire.hook('element.updated', (el)=>{
                if(null !== @this.streamKey && set < 2){
                    set++;
                    document.getElementById('FB-key').select()
                }
            })
        })
    </script>
</div>
