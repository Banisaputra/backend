<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $label;
    public $placeholder;
    public $selected;
    public $options;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = '', $placeholder = '', $selected = null, $options = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->selected = $selected;
        $this->options = $options;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
