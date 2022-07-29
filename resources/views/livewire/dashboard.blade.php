<div class="w-full">
    <div class="bg-white rounded-lg mx-5 my-3 p-2 ">
        <div class="px-4 py-3 flex items-start flex-col lg:flex-row justify-between">
            <div class="w-full lg:mr-4 mb-4">
                <livewire:live-preview/>
                <livewire:new-live-form/>
            </div>
            <div class="sm:w-full">
                @if ($schedules)
                    {{ $nextLive ?  "Next Live: $nextLive->title at $nextLive->start_time" : "" }}
                    <div id="timer"></div>
                    @include('blocks.schedule-today')
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('livewire:load', () => {
            @this.clientTime = clientTime;
            try {
                @this.updateList().then(() => {
                    let timer = new Counter(@this.timeRemains)
                    // timer.display().count()
                });
            } catch (e) {
                // console.log(e)
            }

            class Counter {
                minutesRemains;

                constructor(minutesRemains) {
                    this.minutesRemains = minutesRemains - 2
                }
                display(){
                    let hours = Math.floor(this.minutesRemains / 60);
                    let minutes = Math.floor(this.minutesRemains % 60);
                    document.getElementById("timer").innerHTML =
                        (hours > 0 ? hours + 'h ' : "") + minutes + 'min.';
                    return this;
                }
                count(){
                    let x = setInterval(() =>  {
$                        if(this.minutesRemains >= 1){
                            this.display()
                            this.minutesRemains--;
                        } else {
                            clearInterval(x);
                            @this.emit('dashboard-start-live')
                            document.getElementById("timer").innerHTML = "Starting...";
                        }
                    }, 1000);
                }
            }
        })

        let clientTime = (function(){
            let dt = new Date();
            let minutes = dt.getMinutes();
            return dt.getHours() +
                ":" +
                (minutes < 10 ? "0" : '') +
                minutes
        })();
    </script>
</div>
