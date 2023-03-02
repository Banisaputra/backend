<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextInput extends Component
{
    public $type;
    public $name;
    public $label;
    public $helperText;
    public $validationBagName;
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($type, $name, $helperText = '', $validationBagName = '', $label = '', $placeholder = '')
    {
        $this->type = $type;
        $this->name = $name;
        $this->label = $label;
        $this->helperText = $helperText;
        $this->validationBagName = $validationBagName;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.text-input');
    }
}
