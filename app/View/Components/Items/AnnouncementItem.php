<?php

namespace App\View\Components\Items;

use Illuminate\View\Component;

class AnnouncementItem extends Component
{
    public $title;
    public $message;
    public $datetime;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $message, $datetime)
    {
        $this->title = $title;
        $this->message = $message;
        $this->datetime = $datetime;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.items.announcement-item');
    }
}
