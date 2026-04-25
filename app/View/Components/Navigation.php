<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navigation extends Component
{
    public $href;
    public $icon;
    public $active;

    public function __construct($href = '#', $icon = null, $active = null)
    {
        $this->href = $href;
        $this->icon = $icon;

        // 🔥 auto detect active dari route name
        $this->active = $active ?? request()->routeIs($href . '*');
    }
    public function render(): View|Closure|string
    {
        return view('components.navigation');
    }
}
