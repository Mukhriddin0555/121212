<?php

namespace App\View\Components;

use Illuminate\View\Component;

class link.delete extends Component
{
    public $delete;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($delete)
    {
        $this->delete = $delete;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.link.delete');
    }
}
