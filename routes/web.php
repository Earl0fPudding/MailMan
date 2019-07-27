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
Route::get('/admin/forbiddenusernames', 'AdminController@showForbiddenUsernames')->name('Admin.showForbiddenUsernames');
Route::post('/admin/domains/add', 'AdminController@addDomain')->name('Admin.addDomain');
Route::post('/admin/domains/{id}/update', 'AdminController@updateDomain')->name('Admin.updateDomain');
Route::get('/admin/domains/{id}/delete', 'AdminController@deleteDomain')->name('Admin.deleteDomain');
Route::post('/admin/users/add', 'AdminController@addUser')->name('Admin.addUser');
Route::post('/admin/users/{id}/update', 'AdminController@updateUser')->name('Admin.updateUser');
Route::get('/admin/users/{id}/delete', 'AdminController@deleteUser')->name('Admin.deleteUser');
Route::post('/admin/admins/add', 'AdminController@addAdmin')->name('Admin.addAdmin');
Route::post('/admin/admins/{id}/update', 'AdminController@updateAdmin')->name('Admin.updateAdmin');
Route::get('/admin/admins/{id}/delete', 'AdminController@deleteAdmin')->name('Admin.deleteAdmin');
Route::post('/admin/changePassword', 'AdminController@changePassword')->name('Admin.changePassword');
Route::post('/user/changePassword', 'UserController@changePassword')->name('User.changePassword');
Route::post('/admin/aliases/add', 'AdminController@addAlias')->name('Admin.addAlias');
Route::post('/admin/aliases/{id}/update', 'AdminController@updateAlias')->name('Admin.updateAlias');
Route::get('/admin/aliases/{id}/delete', 'AdminController@deleteAlias')->name('Admin.deleteAlias');
Route::get('/invite/{token}', 'LoginController@processInvite')->name('Login.processInvite');
Route::post('/admin/invites/add', 'AdminController@addInvite')->name('Admin.addInvite');
Route::post('/admin/invites/{id}/update', 'AdminController@updateInvite')->name('Admin.updateInvite');
Route::get('/admin/invites/{id}/delete', 'AdminController@deleteInvite')->name('Admin.deleteInvite');
Route::post('/signup', 'LoginController@signup')->name('Login.signup');
Route::get('/user/dashboard', 'UserController@showDashboard')->name('User.showDashboard');
Route::post('/admin/forbiddenusernames/add', 'AdminController@addForbiddenUsername')->name('Admin.addForbiddenUsername');
Route::get('/admin/forbiddenusernames/{id}/delete', 'AdminController@deleteForbiddenUsername')->name('Admin.deleteForbiddenUsername');
Route::post('/invitesignup', 'LoginController@invitesignup')->name('Login.invitesignup');
Route::get('/about', 'LoginController@showAbout')->name('Login.showAbout');
