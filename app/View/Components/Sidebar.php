<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    public $collapsed = false;

    /**
     * Create a new component instance.
     */
    public function __construct($collapsed = 'false')
    {
        $this->collapsed = filter_var($collapsed, FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar');
    }

}
