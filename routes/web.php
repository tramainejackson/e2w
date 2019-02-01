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

Route::resource('/admin', 'UsersController');

Route::resource('/location', 'TripLocationsController');

Route::post('/locations/ajax_add', 'TripLocationsController@ajax_add');

Route::patch('/locations/ajax_update', 'TripLocationsController@ajax_update');

Route::patch('/locations/add_contact/{participant}/{location}', 'TripLocationsController@add_contact');

Route::resource('/pictures', 'TripPicturesController');

Route::resource('/suggestions', 'TravelSuggestionsController');

Route::resource('/questions', 'TravelQuestionsController');

Route::resource('/participants', 'DistributionListController');

Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/past', 'HomeController@past')->name('past');

Route::get('/photos', 'TripPicturesController@mobile_index')->name('photos');

Route::get('/about_us', function() {
	return view('about_us');
})->name('about_us');

Route::get('/contact_us', function() {
	return view('contact_us');
})->name('contact_us');
