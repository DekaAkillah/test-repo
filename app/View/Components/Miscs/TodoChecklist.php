<?php

namespace App\View\Components\Miscs;

use Illuminate\View\Component;

class TodoChecklist extends Component
{
    public $title;
    public $isChecked;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $isChecked = false)
    {
        $this->title = $title;
        $this->isChecked = $isChecked;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.miscs.todo-checklist');
    }
}
