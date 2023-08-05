<?php

namespace App\View\Components\message;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class successMessage extends Component
{
    public $successMessages;
    /**
     * Create a new component instance.
     */
    public function __construct($successMessages)
    {
        //
        $this->successMessages = $successMessages;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.message.success-message');
    }
}
