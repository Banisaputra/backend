<?php

namespace App\Providers;

use Cache;
use Schema;
use Carbon\Carbon;
use App\Models\NavMenu;
use App\Models\Setting;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        if (Schema::hasTable('settings')) {
            Cache::forever('settings', Setting::all()->toArray());
        }

        $registrar = new \App\Routing\ResourceRegistrar($this->app['router']);

        $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
            return $registrar;
        });

        view()->composer('layouts.default', function ($view) {
            $view->with('menus', NavMenu::with('page')->get());
        });
    }
}
