<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Setting;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:users-create')->only('store');
        $this->middleware('permission:users-read')->only('index');
        $this->middleware('permission:users-update')->only('edit', 'update');
        $this->middleware('permission:users-delete')->only('destroy');
    }

    public function index() {
        $roles = convert_collection_to_select_options(Role::get(), 'display_name', 'name');
        $users = QueryBuilder::for(User::class)
            ->allowedFilters(['username'])
            ->allowedSorts(['username', 'display_name', 'email'])
            ->defaultSort('-id')
            ->with('roles')
            ->paginate()
            ->appends(request()->query());

        return view('dashboard.users.lists', ['users' => $users, 'roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request) {
        $data = $request->validateWithBag('userStoreForm', [
            'display_name' => 'string|nullable',
            'username' => 'required|unique:users|min:3|max:15|regex:/^(?!.*[_.]{2})[a-zA-Z0-9._]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);
        
        $user = User::create($data);
        $user->attachRole($request->input('role'));
        
        notify('success', 'Berhasil membuat akun pengguna!');
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('dashboard.users.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'display_name' => 'string|sometimes|nullable|max:50',
            'email' => 'sometimes|nullable|email|unique:users,email,'.$user->id,
            'password' => 'sometimes|nullable|min:6',
        ]);

        $data = $request->filled('password') ? $request->all() : $request->except(['password']);
        $user->update($data);

        if ($request->has('role')) {
            $user->syncRoles([$request->input('role')]);
        }

        notify('success', 'Data berhasil diperbarui.');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        if (Setting::get('master_account') == $user->id) {
            notify('error', 'Master account tidak dapat dihapus!');
            return redirect()->back();
        }

        $user->delete();
        notify('success', 'Pengguna berhasil dihapus!');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function me(Request $request)
    {
        $id = Auth()->user()->id;
        $request->validate([
            'display_name' => 'string|sometimes|nullable|max:50',
            'email' => 'sometimes|nullable|email|unique:users,email,'.$id,
            'password' => 'sometimes|nullable|min:6',
        ]);

        $user = User::find($id);
        $data = $request->filled('password') ? $request->all() : $request->except(['password']);
        $user->update($data);

        notify('success', 'Data berhasil diperbarui.');
        return redirect()->back()->with('active_tab', 'account');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        notify('success', 'Logout berhasil!');
        return redirect()->route('home');
    }
}
