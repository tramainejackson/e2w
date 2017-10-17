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

Route::get('/admin/questions', 'UsersController@questions')->name('admin.questions');

Route::get('/admin/suggestions', 'UsersController@suggestions')->name('admin.suggestions');

Route::resource('/admin', 'UsersController');

Route::resource('/location', 'TripLocationsController');

Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/about_us', function() {
	return view('about_us');
})->name('about_us');

Route::get('/contact_us', function() {
	return view('contact_us');
})->name('contact_us');
