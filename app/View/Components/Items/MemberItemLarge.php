<?php

namespace App\View\Components\Items;

use Illuminate\View\Component;

class MemberItemLarge extends Component
{
    public $id;
    public $name;
    public $major;
    public $role;
    public $institution;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $name, $major, $role, $institution)
    {
        $this->id = $id;
        $this->name = $name;
        $this->major = $major;
        $this->role = $role;    
        $this->institution = $institution;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.items.member-item-large');
    }
}
