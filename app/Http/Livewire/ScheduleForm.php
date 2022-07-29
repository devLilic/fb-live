<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ScheduleForm extends Component
{
    public $pages;
    public $title;
    public $time;
    public $duration;

    public function mount()
    {
        $this->pages = auth()->user()->fbUser->fbPages;
    }

    public function render()
    {
        return view('livewire.schedule-form');
    }
}
