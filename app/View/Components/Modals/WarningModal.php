<?php

namespace App\View\Components\Modals;

use Illuminate\View\Component;

class WarningModal extends Component
{
    public $title, $message, $usePrimaryButton, $primaryLabel, $primaryAction, $secondaryLabel, $secondaryAction;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = 'Warning', $message, $usePrimaryButton = "true", $primaryLabel='', $primaryAction='', $secondaryLabel = 'Close', $secondaryAction = '')
    {
        $this->title = $title;
        $this->message = $message;
        $this->usePrimaryButton = $usePrimaryButton;
        $this->primaryLabel = $primaryLabel;
        $this->primaryAction = $primaryAction;
        $this->secondaryLabel = $secondaryLabel;
        $this->secondaryAction = $secondaryAction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modals.warning-modal');
    }
}
