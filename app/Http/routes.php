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

Route::get('/', 'HomeController@index');


Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


//angular routes

Route::get('/getCategories/{id}', 'CategoryController@index');
Route::get('/getAdvertisements/{id}', 'AdvertisementController@index');


//User routes
Route::get('/my_account/{id}', 'UserController@show');
Route::get('/edit_account/{id}', 'UserController@edit');
Route::get('/update_account/{id}', 'UserController@update');


