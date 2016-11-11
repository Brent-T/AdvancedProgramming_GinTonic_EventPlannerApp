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

Route::get('/home', 'HomeController@index');

Route::group(['prefix' => 'events'], function () {
	Route::get('/', 'EventsController@index');
	Route::get('/{event_id}', 'EventsController@detail')->where('event_id', '[0-9]+');
	Route::post('/addEvent', 'EventsController@addEvent');
});