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

Route::get('/', 'Login@showLogin')->name('Login.showLogin');
Route::get('/start', 'Login@showStartPage')->name('Login.showStartPage');
Route::post('/login', 'Login@login')->name('Login.login');
Route::get('/logout', 'Login@logout')->name('Login.logout');
Route::get('/refreshCaptcha', 'Captcha@refreshCaptcha')->name('Captcha.refreshCaptcha');
