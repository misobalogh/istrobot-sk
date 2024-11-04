<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RobotForm extends Component
{
    public $robot;
    public $technologies;
    public $actionUrl;
    public $method;
    public $buttonText;

    public function __construct($robot = null, $technologies = null, $actionUrl = null, $method = null, $buttonText = null)
    {
        $this->robot = $robot;
        $this->technologies = $technologies;
        $this->actionUrl = $actionUrl;
        $this->method = $method;
        $this->buttonText = $buttonText;
    }

    public function render()
    {
        return view('components.robot-form');
    }
}
