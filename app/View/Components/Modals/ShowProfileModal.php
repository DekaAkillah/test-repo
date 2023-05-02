<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class ShowProfileModal extends Component
{
    public $id;
    public $name;
    public $major;
    public $avatar;
    public $institution;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $major, $avatar, $institution)
    {
        $this->id = $id;
        $this->name = $name;
        $this->major = $major;
        $this->avatar = $avatar;
        $this->institution = $institution;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.show-profile-modal');
    }
}
