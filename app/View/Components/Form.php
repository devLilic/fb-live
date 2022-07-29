<?php

namespace App\View\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class Form extends Component {

    public $method;
    public $standardMethod;

    public $action;

    private $acceptedMethods = ['GET', 'POST', 'PATCH', 'PUT', 'DELETE'];

    public function __construct($action, $method = 'POST')
    {
        $this->action = $action;
        $this->method = Str::of($method)->upper()->trim();
        $this->standardMethod = ($this->method == 'GET') ? 'GET' : 'POST';
    }

    public function hasMethod(): bool
    {
        return (!in_array($this->method, ['GET', 'POST']) && in_array($this->method, $this->acceptedMethods));
    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.index');
    }
}
