<?php

namespace App\View\Components\message;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class warningMessage extends Component
{
    public $warningMessages;
    /**
     * Create a new component instance.
     */
    public function __construct($warningMessages)
    {
        //
        $this->warningMessages = $warningMessages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message.warning-message');
    }
}
