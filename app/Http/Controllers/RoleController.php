<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:roles-create')->only('store');
        $this->middleware('permission:roles-update')->only('update');
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validateWithBag('roleStoreForm', [
            'display_name' => 'required|min:3',
            'description' => 'nullable|max:255',
        ]);

        Role::create([
            'name' => strtolower(str_replace(' ', '_', $request->display_name)),
            'display_name' => $request->display_name,
            'description' => $request->description,
        ]);

        notify('success', 'Role berhasil dibuat!');
        return redirect()->back()->with('active_tab', 'rbac');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->validate([
            'display_name' => 'required|min:3',
            'description' => 'nullable|max:400',
        ]);

        $role->update($data);

        notify('success', 'Role berhasil diperbarui.');
        return redirect()->route('settings.index')->with('active_tab', 'rbac')->send();
    }

    /**
     * Update role permissions.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePermission(Request $request)
    {
        $roles = Role::get();
        foreach ($roles as $role) {
            $permissions = $request->roles[$role->name] ?? [];
            $role->syncPermissions($permissions);
        }

        notify('success', 'RBAC berhasil diperbarui!');
        return redirect()->back()->with('active_tab', 'rbac');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('dashboard.rbac.edit', ['role' => $role]);
    }
}
