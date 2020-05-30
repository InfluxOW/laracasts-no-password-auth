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

Route::view('/', 'welcome')->name('welcome');

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', 'Auth\AuthController@login');
    Route::post('login', 'Auth\AuthController@postLogin')->name('login');
    Route::get('auth/token/{token:token}', 'Auth\AuthController@authenticate')->name('auth.token');

    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::group(['middleware' => 'auth'], function () {
    Route::view('/home', 'home')->name('home');
    Route::post('logout', 'Auth\AuthController@logout')->name('logout');
});
