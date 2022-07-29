<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Facebook\Exceptions\FacebookAuthenticationException;
use Illuminate\Support\Str;
use Livewire\Component;

class Dashboard extends Component {

    public $schedules;
    public $clientTime;
    public $nextLive;
    public $timeRemains;
    public $isLiveNow = false;

    protected $listeners = [
        'dashboard-start-live' => 'liveInit',
        'live-stop' => 'continueSchedule'
    ];

    public function continueSchedule()
    {
        $this->isLiveNow = false;
    }

    public function liveInit()
    {
        $this->isLiveNow = true;
        $this->emit('live-init', $this->nextLive->live_title);
    }

    public function updateList()
    {
        try {
            $this->schedules = $this->getTodayList();
            $this->nextLive = $this->schedules->first();
            if ($this->nextLive){
                $this->calculateRemainingTime();
            }
        } catch (FacebookAuthenticationException $e) {
            redirect()->route('fb.auth');
        }
        return json_encode($this->nextLive);
    }

    public function getNextLive()
    {
        return $this->nextLive;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    protected function getTodayList()
    {
        $user = $this->getUser();

        if ($this->clientTime < 10) {
            $this->clientTime = "0".$this->clientTime;
        }
        return $user->fbPages->first()->schedules
            ->where('start_time', ">=", $this->clientTime . ":00")
            ->where('disabled', false)
            ->filter(function ($value)
            {
                return Str::of($value->days)->contains(Carbon::now()->dayOfWeekIso);
            })
            ->sortBy('start_time');
    }

    protected function calculateRemainingTime()
    {
        // get current client time
        $time = Carbon::createFromFormat("H:i", $this->clientTime);
        $timeRemains = Carbon::parse($this->nextLive->start_time);
        $this->timeRemains = $timeRemains->diffInMinutes($time);
    }


}
