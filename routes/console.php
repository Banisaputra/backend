<?php

use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('reset-password', function () {
    $masterAccountId = get_cache('master_account');
    if (!$masterAccountId) {
        $this->comment('No account found.');
    }

    $randomPassword = \Str::random(10);
    $user = User::where('id', $masterAccountId)->first();
    $user->update([
        'password' => $randomPassword,
    ]);
    
    $this->comment('Please use this password to sign in: ' . $randomPassword);
})->purpose('Reset Master Account Password');
