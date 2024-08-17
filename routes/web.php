<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::resource('order', 'orderController');

Route::fallback(function(){
    return view('not_found');
});
