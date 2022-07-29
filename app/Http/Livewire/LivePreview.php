<?php

namespace App\Http\Livewire;

use Barryvdh\Debugbar\Facades\Debugbar;
use Facades\App\Services\Live;
use Livewire\Component;

class LivePreview extends Component {

    public $url;
    public $videoHidden = false;
    public $color = 'gray';

    public $streamStatus = "LIVE";

    protected $listeners = [
        'live-created' => 'start',
        'live-stop' => 'stop',
        'live-stream-ready' => 'streamReady'
    ];

    public function render()
    {
        return view('livewire.live-preview');
    }

    public function start($published)
    {
        if ($published) { // published is TRUE if status of Live is LIVE_NOW
            $this->url = Live::getPreview();
            $this->videoHidden = FALSE;
        } else { // FALSE if status is UNPUBLISHED
            $live = Live::get();
            do {
                sleep(2);
            } while (!Live::previewReady($live));

            $this->setColor("PREVIEW");
        }
    }

    public function stop()
    {
        $this->videoHidden = TRUE;
        $this->setColor('DEFAULT');
        $this->url = '';
    }

    public function streamReady()
    {
        $this->setColor('PREVIEW');
    }

    protected function setColor($status)
    {
        $colors = [
            "DEFAULT" => 'gray',
            "PREVIEW" => "green"
        ];
        $this->color = $colors[$status];
    }
}
