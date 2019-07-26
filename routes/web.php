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
Route::get('/admin', 'LoginController@showAdminLogin')->name('Login.showAdminLogin');
Route::post('/admin', 'LoginController@adminLogin')->name('Login.adminLogin');
Route::get('/admin/dashboard', 'AdminController@showDashboard')->name('Admin.showDashboard');
Route::get('/admin/users', 'AdminController@showUsers')->name('Admin.showUsers');
Route::get('/admin/admins', 'AdminController@showAdmins')->name('Admin.showAdmins');
Route::get('/admin/aliases', 'AdminController@showAliases')->name('Admin.showAliases');
Route::get('/admin/invites', 'AdminController@showInvites')->name('Admin.showInvites');
Route::get('/admin/domains', 'AdminController@showDomains')->name('Admin.showDomains');
Route::post('/admin/domains/add', 'AdminController@addDomain')->name('Admin.addDomain');
Route::post('/admin/domains/{id}/update', 'AdminController@updateDomain')->name('Admin.updateDomain');
Route::get('/admin/domains/{id}/delete', 'AdminController@deleteDomain')->name('Admin.deleteDomain');
Route::post('/admin/users/add', 'AdminController@addUser')->name('Admin.addUser');
Route::post('/admin/users/{id}/update', 'AdminController@updateUser')->name('Admin.updateUser');
Route::get('/admin/users/{id}/delete', 'AdminController@deleteUser')->name('Admin.deleteUser');
Route::post('/admin/admins/add', 'AdminController@addAdmin')->name('Admin.addAdmin');
Route::post('/admin/admins/{id}/update', 'AdminController@updateAdmin')->name('Admin.updateAdmin');
Route::get('/admin/admins/{id}/delete', 'AdminController@deleteAdmin')->name('Admin.deleteAdmin');
