<?php

namespace App\Http\Livewire;

use App\Models\FbLive;
use App\Services\FbApi;
use Barryvdh\Debugbar\Facades\Debugbar;
use Facades\App\Services\Live;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Component;

class NewLiveForm extends Component {

    public $title;
    public $streamKey;
    public $message;
    public $isLive = false;
    private $published = TRUE;

    protected $listeners = [
        'scheduled-live-start' => 'startScheduled',
        'live-start' => 'startLive',
        'scheduled-live-stop' => 'stopLive',
        'scheduled-go-live' => 'changeStatus'
    ];

    public function startScheduled($title)
    {
        $this->title = $title;
        $this->published = FALSE;
        $this->streamKey = Live::create($this->title, $this->published)
            ->stream_key;
        $this->emitTo('live-preview', 'live-created', $this->published);
        $this->isLive = true;
    }

    public function startLive()
    {
        $this->streamKey = Live::create($this->title, $this->published)
            ->stream_key;
        $this->emitTo('live-starter', 'stop-counter');
        $this->emitTo('live-preview', 'live-created', $this->published);
        $this->isLive = true;
    }

    public function stopLive()
    {
        Live::end();
        $this->title = '';
        $this->streamKey = '';
        $this->isLive = false;
        $this->emit('live-stop');
    }

    public function changeStatus()
    {
        Live::activate();
        $this->published = TRUE;
        $this->emitTo('live-preview', 'live-created', $this->published);
    }

    public function render()
    {
        return view('livewire.new-live-form');
    }
}
