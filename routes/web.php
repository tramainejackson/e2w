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

Route::resource('/pictures', 'TripPicturesController');

Route::resource('/suggestions', 'TravelSuggestionsController');

Route::resource('/questions', 'TravelQuestionsController');

Route::resource('/participants', 'DistributionListController');

Route::get('/', 'HomeController@index')->name('welcome');

Route::get('/past', 'HomeController@past')->name('past');

Route::get('/about_us', function() {
	$agent = new \Jenssegers\Agent\Agent();
	
	if($agent->isMobile()) {
		return view('mobile.about_us');		
	} else {
		return view('about_us');		
	}
})->name('about_us');

Route::get('/contact_us', function() {
	$agent = new \Jenssegers\Agent\Agent();
	
	if($agent->isMobile()) {
		return view('mobile.contact_us');
	} else {
		return view('contact_us');
	}
})->name('contact_us');
