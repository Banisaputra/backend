<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class DataTable extends Component
{
    public $columns;
    public $rows;
    public $withCheckboxes;
    public $withActions;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($columns = [], $rows = [], $withCheckboxes = true, $withActions = true)
    {
        $this->columns = collect($columns);
        $this->rows = $rows;
        $this->withCheckboxes = $withCheckboxes;
        $this->withActions = $withActions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.data-table');
    }
}
