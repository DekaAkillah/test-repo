<?php

namespace App\View\Components\Inputs;

use Illuminate\View\Component;

class StrokeInput extends Component
{
    /**
     * The input placeholder
     *
     * @var string
     */
    public $placeholder;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder)
    {
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.inputs.stroke-input');
    }
}
