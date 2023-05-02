<?php

namespace App\View\Components\Buttons;

use Illuminate\View\Component;

class OutlinedButton extends Component
{
    /**
     * The button label
     *
     * @var string
     */
    public $label;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label)
    {
        $this->label = $label;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.buttons.outlined-button');
    }
}
