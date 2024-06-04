<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/reset', '')->name('reset');
Route::get('/balance', '')->name('balance');
Route::post('/event', '')->name('event');
