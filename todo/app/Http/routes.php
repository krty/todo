<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/', function () {
//     return view('tasks');
// });

Route::group(['middleware' => ['web']], function () {
	Route::get('/', 'TaskController@show');

	/**
	 * Add A New Task
	 */
	Route::post('/task', 'TaskController@create');
	Route::get('task/{id}/active','TaskController@getdone');
	Route::post('task/{id}/active','TaskController@done');

	/**
	 * Delete An Existing Task
	 */
	Route::delete('/task/{id}', 'TaskController@delete');
});