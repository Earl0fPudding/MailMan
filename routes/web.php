<?php

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

Route::get('/', 'LoginController@showLogin')->name('Login.showLogin');
Route::get('/start', 'LoginController@showStartPage')->name('Login.showStartPage');
Route::post('/login', 'LoginController@login')->name('Login.login');
Route::get('/logout', 'LoginController@logout')->name('Login.logout');
Route::get('/refreshCaptcha', 'CaptchaController@refreshCaptcha')->name('Captcha.refreshCaptcha');
