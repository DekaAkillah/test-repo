<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class OutlinedInput extends Component
{
    /**
     * The input placeholder.
     *
     * @var string
     */
    public $placeholder;
    /**
     * The input value.
     *
     * @var string
     */
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder = "", $value = "")
    {
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.outlined-input');
    }
}
