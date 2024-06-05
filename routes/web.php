<?php

use App\Http\Controllers\AccountController;
use App\Http\Middleware\CustomMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/balance', 'App\Http\Controllers\AccountController@balance')->name('balance');
Route::post('/event', 'App\Http\Controllers\AccountController@event')->name('event');
// Route::post('/reset', '')->name('reset');

