<?php

namespace App\View\Components\message;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class errorMessage extends Component
{
    public $errorMessages;
    /**
     * Create a new component instance.
     */
    public function __construct($errorMessages)
    {
        //
        $this->errorMessages = $errorMessages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message.error-message');
    }
}
