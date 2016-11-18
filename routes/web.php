<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Route::get('/login', 'HomeController@login');

Route::get('/signup', 'HomeController@signup');

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'events'], function () {
	Route::get('/', 'EventsController@index');
	Route::get('/overview', 'EventsController@index');
	Route::get('/{event_id}', 'EventsController@detail')->where('event_id', '[0-9]+');
	Route::post('/addEvent', 'EventsController@addEvent');

	Route::group(['prefix' => '/{event_id}'], function () {
		Route::post('/suggestdate', 'EventsController@addSuggestedDateToEvent')->where('event_id', '[0-9]+');
		Route::post('/suggestlocation', 'EventsController@addSuggestedLocationToEvent')->where('event_id', '[0-9]+');
	});

});

Route::group(['prefix' => 'user'], function () {
	Route::get('/{user_id}/profile', 'UserController@profile')->where('user_id', '[0-9]+');
});