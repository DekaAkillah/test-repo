<?php

namespace App\View\Components\Miscs;

use Illuminate\View\Component;

class Badge extends Component
{
    public $label;

    public $theme;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label, $theme = 'dark')
    {
        $this->label = $label;
        $this->theme = $theme;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.miscs.badge');
    }
}
