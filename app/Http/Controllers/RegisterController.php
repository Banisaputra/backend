<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;

class RegisterController extends Controller
{
    public function __construct() {
        if (!Setting::get('anyone_can_register')) {
            return redirect()->route('home')->send();
        }
    }

    public function index() {
        return view('register');
    }

    public function store() {
        $this->validate(request(), [
            'display_name' => 'string|nullable',
            'username' => 'required|unique:users|min:3|max:15|regex:/^(?!.*[_.]{2})[a-zA-Z0-9._]+$/u',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        $defaultRole = Setting::get('default_user_role');
        
        $user = User::create(request(['display_name', 'username', 'email', 'password']));
        $user->attachRole($defaultRole);
        
        Auth()->login($user);

        notify('success', 'Selamat datang, '. $user->name .'!');
        return redirect()->route('home');
    }
}
