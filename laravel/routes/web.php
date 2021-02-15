<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::post('/update', 'HomeController@update')->name('update');
Route::get('/delete', 'HomeController@iconDelete')->name('delete');
