<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', function () {
    return view('/sign-up-vendor');
    //return view('welcome');
});

Route::post('sign-up', function () {
    return view('sign-up');
});

Route::get('sign-up-vendor', function () {
    return view('sign-up-vendor');
});

Route::post('sign-up-vendor', 'SignUp@saveVendor');

Route::get('sign-up-user', function () {
    return view('sign-up-user');
});
