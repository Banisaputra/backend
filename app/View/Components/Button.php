<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $label;
    public $theme;
    public $size;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($label = '', $theme = 'default', $size = 'default')
    {
        $this->label = $label;
        $this->theme = $theme;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button');
    }
}
