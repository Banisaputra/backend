<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class DataViewer extends Component
{
    public $searchByKey;
    public $withFilter;
    public $withBulkAction;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($searchByKey = null, $withFilter = true, $withBulkAction = true)
    {
        $this->searchByKey = $searchByKey;
        $this->withFilter = $withFilter;
        $this->withBulkAction = $withBulkAction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.data-viewer');
    }
}
