<?php

namespace App\Http\Controllers;

use App\Models\NavMenu;
use Illuminate\Http\Request;

class NavMenuController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:menus-create')->only('create', 'store');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $menus = [];
        foreach ($request->label as $index => $value) {
            $menus[$index] = [
                'label' => $value,
                'object_type' => $request->object_type[$index],
                'object_value' => $request->object_value[$index],
            ];
        }

        NavMenu::truncate();
        NavMenu::insert($menus);

        notify('success', 'Berhasil memperbarui menu.');
        return redirect()->back()->with('active_tab', 'menus');
    }
}
