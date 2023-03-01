<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class SidebarCard extends Component
{

    public $title;
    public $items;
    public $type;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $items, $type)
    {
        //
        $this->title = $title;
        $this->items = $items;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {   
        // check component arguments
        // dd($this);
        return view('components.sidebar-card', ['number'=>55]);
    }
}
