<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('info', function () {
        return phpinfo();
    });
    
    Route::get('onboarding', 'SettingController@onboarding')->name('onboarding');
    Route::post('onboarding', 'SettingController@installation')->name('installation');

    Route::get('', 'PageController@homepage')->name('home');
    Route::get('galeri', 'PageController@gallery')->name('gallery');
    Route::get('peta-rawan-pangan', 'RawanPanganController@map')->name('peta-rawan-pangan');
    Route::get('kelompok-wanita-tani', 'KelompokTaniController@search')->name('search-kwt');

    Route::group(['middleware' => 'guest'], function () {
        Route::resource('login', 'LoginController')->only('index', 'store');
        Route::resource('register', 'RegisterController')->only('index', 'store');
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', 'UserController@logout')->name('logout');

        Route::group(['prefix' => 'dashboard'], function () {
            Route::get('', 'DashboardController@index')->name('dashboard');

            Route::resource('settings', 'SettingController')->only('index', 'store', 'update');
            Route::resource('users', 'UserController')->only('index', 'store', 'edit', 'update', 'destroy');
            Route::resource('posts', 'PostController')->only('untrash', 'bulkaction');
            Route::resource('galleries', 'GalleryController')->only('index', 'edit', 'create');
            Route::resource('articles', 'ArticleController')->only('index', 'edit', 'create');
            Route::resource('pages', 'PageController')->only('index', 'edit', 'create');
            Route::resource('categories', 'CategoryController')->only('store', 'edit', 'update', 'destroy');
            Route::resource('commodities', 'CommodityController')->only('index', 'show', 'store', 'edit', 'update', 'destroy');
            Route::resource('rawan-pangan', 'RawanPanganController')->only('index', 'store');
            Route::resource('skpg', 'SKPGController')->only('index', 'store');
            Route::resource('kelompok-tani', 'KelompokTaniController')->only('index', 'store', 'edit', 'update', 'destroy');
            Route::resource('menus', 'NavMenuController')->only('create', 'store');
            Route::resource('rbac', 'RoleController')->only('store', 'edit', 'update');

            Route::get('skpg/show', 'SKPGController@show')->name('skpg.show');
            Route::get('komoditas/export', 'CommodityController@export')->name('commodities.export');
            Route::get('kelompok-tani/export', 'KelompokTaniController@export')->name('kelompok-tani.export');
            Route::post('roles', 'RoleController@updatePermission')->name('roles.update');
            Route::put('me', 'UserController@me')->name('me');
        });
    });

    Route::get('category/{slug}', 'CategoryController@show')->name('category');
    Route::get('blog', 'PostController@blog')->name('blog');
    Route::get('{slug}', 'PostController@show')->name('post');
});
