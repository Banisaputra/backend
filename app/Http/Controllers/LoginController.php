<?php

namespace App\Http\Controllers;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store() {
        $auth = Auth()->attempt(request(['username', 'password']));

        if (!$auth) {
            return redirect()->route('login.index')->withInput(request()->only('username'))->withErrors([
                'message' => 'Username atau password yang anda masukkan salah.'
            ]);
        }

        $destination = Auth()->user()->hasRole('administrator') ? 'dashboard' : 'home';
        
        notify('success', 'Selamat datang, '. Auth()->user()->display_name .'!');
        return redirect()->route($destination);
    }
}
