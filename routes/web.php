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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UserController')->only(['index', 'show']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/account/security/edit', 'AccountController@editSecurity')->name('account.editSecurity');
    Route::patch('/account/password/update', 'AccountController@updatePassword')->name('account.updatePassword');
    Route::patch('/account/email/update', 'AccountController@updateEmail')->name('account.updateEmail');
    Route::resource('account', 'AccountController')->only(['edit', 'update', 'destroy']);
    Route::resource('taskstatuses', 'TaskStatusController')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::resource('tasks', 'TaskController');
});
