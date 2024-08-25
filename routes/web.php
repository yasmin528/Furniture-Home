<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('order', 'orderController');

Route::fallback(function(){
    return view('not_found');
});

Route::group(['prefix' => 'Admin'], function() {
    Route::get('login', [App\Http\Controllers\AuthAdmin\LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [App\Http\Controllers\AuthAdmin\LoginController::class, 'login'])->name('admin.login.submit');

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
        Route::resource('products', 'productController');
        Route::post('logout', [App\Http\Controllers\AuthAdmin\LoginController::class, 'logout'])->name('admin.logout');
    });
});
