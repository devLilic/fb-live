<div>
    <h2 class="mb-3 text-xl">
        @if($nextLive)
            <span>Next Live: {{$nextLive->title}} at {{$nextLive->start_time}}</span>
            <p class="text-xs">Stream key generates 3 minutes earlier</p>
        @endif
    </h2>

    <div id="timer" class="timer"></div>
    <x-form.button wire:click='toggleCount'
                   id="stopInterval"
                   type="button"
                   class="mb-2">
        {{ $count ? 'Pause' : 'Start' }}
    </x-form.button>
    @if($schedules)
        @include('blocks.schedule-today')
    @endif

    <script type="text/javascript">
        let btn = document.getElementById('stopInterval')
        btn.addEventListener('click', ()=>{
            Timer.stopInterval();
        });

        document.addEventListener('livewire:load', () => {
            @this.clientTime = clientTime;
            filterLives();
        });

        let filterLives = () => {
            try {
                @this.filterLives().then((data) => {
                    if (data !== "null"){
                        let duration = JSON.parse(data).duration;
                        let timer = new Timer(@this.startsIn, duration)
                        timer.count()
                    } else {
                        document.getElementById("timer").innerHTML = "No more items for today"
                    }
                });
            } catch (e) {
                // console.log(e)
            }
        }

        class Timer {
            minutesRemains;
            interval;
            videoLife;
            phase = 0;
            pause = false;
            timerInterval = 60000; // 1 minute

            constructor(minutesRemains, duration) {
                this.minutesRemains = minutesRemains;
                this.videoLife = duration;
                this.isLiveReady = 0;
            }

            process(minutes) {
                if (-1 !== minutes) {
                    document.getElementById("timer").innerHTML = this.formatTimer(minutes);
                } else {
                    clearInterval(this.interval);
                    this.phase++;
                    if (this.phase === 1) {
                        @this.emitSelf('scheduled-live-init'); // 'scheduled-live-init'
                        this.minutesRemains = 5;
                        this.interval = setInterval(this.callback, this.timerInterval)
                    } else if (this.phase === 2){
                        this.minutesRemains = this.videoLife
                        this.interval = setInterval(this.callback, this.timerInterval)
                        @this.emit('scheduled-go-live'); // newLiveForm changes status to LIVE_NOW
                    } else if(this.phase === 3){
                        @this.emit('scheduled-live-stop'); // newLiveForm will stop the live
                        filterLives();
                    }
                }
            }

            formatTimer(minutes) {
                let hours = Math.floor(minutes / 60);
                let mins = Math.floor(minutes % 60);
                return "<span class='counter'>"+ this.addZero(hours) + "</span>" +
                    "<span class='counter'>:</span>" +
                    "<span class='counter'>" + this.addZero(mins) + "</span>";
            }

            addZero(num){
                return (num < 10 ? "0" : "") + num;
            }

            count() {
                this.interval = setInterval(this.callback, this.timerInterval)
            }

            callback = () => {
                if (this.minutesRemains >= 1) {
                    this.process(this.minutesRemains)
                    this.minutesRemains--;
                } else {
                    this.process(-1)
                }
            }

            stopInterval() {
                this.pause = ! this.pause;
                console.log('btn ' + this.pause);
                this.pause ? clearInterval(this.interval) : filterLives()
            }
        }


        let clientTime = (function () {
            let dt = new Date();
            let minutes = dt.getMinutes();
            let hours = dt.getHours();
            return (hours < 10 ? "0" : "") +
                hours + ":" +
                (minutes < 10 ? "0" : "") +
                minutes
        })();
    </script>
</div>
