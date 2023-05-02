<?php

namespace App\View\Components\Items;

use Illuminate\View\Component;

class CompetitionItem extends Component
{
    public $competition;
    public $team;
    public $stage;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($competition, $team, $stage)
    {
        $this->competition = $competition;
        $this->team = $team;
        $this->stage = $stage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.items.competition-item');
    }
}
