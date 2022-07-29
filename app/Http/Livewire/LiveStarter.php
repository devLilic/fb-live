<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Facebook\Exceptions\FacebookAuthenticationException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;

class LiveStarter extends Component {

    public $schedules;
    public $clientTime;
    public $nextLive;
    public $startsIn;

    private $timeBetweenInitAndStart = 5;

    public $isLive = FALSE;
    public $count = TRUE;

    protected $listeners = [
        'scheduled-live-init' => 'liveInit',
        'stop-counter' => 'stopCounter',
    ];

    public function liveInit()
    {
        $this->emitTo('new-live-form', 'scheduled-live-start', $this->nextLive->title);
    }

    public function stopCounter()
    {
        $this->isLive = TRUE;
    }

    public function toggleCount()
    {
        $this->count = !$this->count;
    }

    public function filterLives()
    {
        try {
            $this->schedules = $this->getTodayList();
        } catch (FacebookAuthenticationException $e) {
            Log::alert("Redirected to login page;" . $e->getCode() . "; " . $e->getMessage());
            redirect()->route('fb.auth');
        }

        $this->nextLive = $this->getNextLive();

        if ($this->nextLive) {
            $this->startsIn = $this->waitTime();
        } else {
            $this->startsIn = "All lives for today are done!";
        }

        return json_encode($this->nextLive);
    }


    /**
     * get a list of Schedules for current user
     * which have start time later today
     * @return mixed
     * @throws FacebookAuthenticationException
     */
    protected function getTodayList()
    {
        return $this->getUser()->fbPages->first()->schedules
            ->where('start_time', ">=", $this->clientTime . ":00")
            ->where('disabled', false)
            ->filter(function ($value)
            {
                return Str::of($value->days)->contains(Carbon::now()->dayOfWeekIso);
            })
            ->sortBy('start_time');
    }

    /**
     * return first Schedule for today or False if there are no schedules
     * @return mixed
     */
    protected function getNextLive()
    {
        return $this->schedules ? $this->schedules->first() : false;
    }

    private function getUser()
    {
        $fbUser = auth()->user()->fbUser;
        if (!$fbUser) {
            throw new FacebookAuthenticationException();
        }

        return $fbUser;
    }

    protected function waitTime()
    {
        return $this->calculateRemainingTime() - $this->timeBetweenInitAndStart;
    }

    protected function calculateRemainingTime(): int
    {
        $time = Carbon::now()->setHour($this->clientTime);
        $timeRemains = Carbon::parse($this->nextLive->start_time);

        return $timeRemains->diffInMinutes($time);
    }

    public function render()
    {
        return view('livewire.live-starter');
    }
}
