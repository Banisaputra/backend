<?php

namespace App\Http\Controllers;

use Storage;
use App\Models\Category;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\File;
use App\Models\NavMenu;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:settings-read')->only('index');
        $this->middleware('permission:settings-update')->only('store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = NavMenu::all();
        $categories = Category::withCount('posts')->get();
        $roles = Role::with('permissions')->get();
        $permissions = Permission::get();

        return view('dashboard.settings.index', compact('menus', 'categories', 'roles', 'permissions'));
    }

    public function onboarding()
    {
        return view('onboarding');
    }

    public function installation(Request $request)
    {
        return DB::transaction(function() use ($request) {
            $this->validate(request(), [
                'site_name' => 'required',
                'username' => 'required|unique:users|min:3|max:15|regex:/^(?!.*[_.]{2})[a-zA-Z0-9._]+$/u',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:6'
            ]);
            
            $user = User::create(request(['username', 'email', 'password']));
            $user->attachRole('administrator');

            Setting::insert([
                [
                    'key' => 'site_name',
                    'value' => request()->get('site_name'),
                ],
                [
                    'key' => 'has_completed_setup',
                    'value' => true,
                ],
                [
                    'key' => 'master_account',
                    'value' => $user->id,
                ],
                [
                    'key' => 'default_user_role',
                    'value' => Role::first()->name,
                ],
            ]);
            
            Auth()->login($user);
            notify('success', 'The installation was successfull.');

            return redirect()->route('home');
        });
    }

    /**
     * Update general settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('has_completed_setup', 'master_account', '_token');
        $rules = collect(config('settings'))->flatten(1)->keyBy('attributes.name')->map(function ($value) {
            return $value['rules'];
        })->toArray();

        $this->validate($request, $rules);

        foreach($data as $key => $value) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);

                $path = $file->store('public/files');
                $name = $file->getClientOriginalName();

                $data = new File();
                $data->name = $name;
                $data->path= $path;
                $data->size= $file->getSize();
                $data->type= $file->getClientMimeType();
                $data->save();

                $request->merge([$key => Storage::url($path)]);
            }

            Setting::updateOrCreate([ 'key' => $key ], [
                'value' => $request->get($key),
            ]);
        }

        notify('success', 'Pengaturan berhasil diperbarui.');
        return redirect()->back()->with('active_tab', 'general');
    }

    /**
     * Update general settings.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $key)
    {
        $rules = collect(config('settings'))->flatten(1)->where('attributes.name', $key)->map(function ($value) {
            return $value['rules'];
        })->toArray();

        $this->validate($request, $rules);

        if ($request->hasFile($key)) {
            $file = $request->file($key);

            $path = $file->store('public/files');
            $name = $file->getClientOriginalName();

            $data = new File();
            $data->name = $name;
            $data->path= $path;
            $data->size= $file->getSize();
            $data->type= $file->getClientMimeType();
            $data->save();

            $request->merge([$key => Storage::url($path)]);
        }

        Setting::updateOrCreate([ 'key' => $key ], [
            'value' => $request->get($key),
        ]);

        notify('success', 'Pengaturan berhasil diperbarui.');
        return redirect()->back()->with('active_tab', 'general');
    }
}
