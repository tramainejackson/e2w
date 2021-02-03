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

Route::get('/test', function() {
	$contact = App\Contact::find(2);
	$participant = $contact->trips->first();

	return view('emails.new_message', compact('contact', 'participant'));
})->name('test');

/* Overwrite the default login/register controller */
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/register', 'Auth\RegisterController@index');
/* Overwrite the default login/register controller */

/* Resource Controllers */
Route::resource('/admin', 'UsersController');
Route::resource('/location', 'TripLocationsController');
Route::resource('/pictures', 'TripPicturesController');
Route::resource('/suggestions', 'TravelSuggestionsController');
Route::resource('/questions', 'TravelQuestionsController');
Route::resource('/participants', 'DistributionListController');
Route::resource('/contacts', 'ContactController');
/* Resource Controllers */

Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/past', 'HomeController@past')->name('past');

Route::get('/photos', 'TripPicturesController@mobile_index')->name('photos');

Route::get('/about_us', function() {
	return view('about_us');
})->name('about_us');

Route::get('/contact_us', function() {
	return view('contact_us');
})->name('contact_us');

Route::post('/locations/ajax_add', 'TripLocationsController@ajax_add');

Route::patch('/locations/ajax_update', 'TripLocationsController@ajax_update');

Route::patch('/locations/add_contact/{participant}/{location}', 'TripLocationsController@add_contact');

Route::delete('/locations/ajax_delete', 'TripLocationsController@ajax_delete');