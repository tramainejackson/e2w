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

Auth::routes();

Route::get('/', 'HomeController@index')->name('welcome');

Route::resource('/admin', 'UserController');

Route::get('/admin/questions', 'UserController@questions')->name('admin.questions');

Route::get('/admin/suggestions', 'UserController@suggestions')->name('admin.suggestions');

Route::get('/about_us', function() {
	return view('about_us');
})->name('about_us');

Route::get('/contact_us', function() {
	return view('contact_us');
})->name('contact_us');
