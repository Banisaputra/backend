<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $openButton;
    public $isOpen;
    public $withHeader;
    public $withFooter;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title = '', $openButton = null, $isOpen = false, $withHeader = true, $withFooter = true)
    {
        $this->title = $title;
        $this->openButton = $openButton;
        $this->isOpen = $isOpen;
        $this->withHeader = $withHeader;
        $this->withFooter = $withFooter;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
