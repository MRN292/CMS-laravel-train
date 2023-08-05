<?php

namespace App\View\Components\message;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class infoMessage extends Component
{
    public $infoMessages;
    /**
     * Create a new component instance.
     */
    public function __construct($infoMessages)
    {
        //
        $this->infoMessages = $infoMessages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message.info-message');
    }
}
