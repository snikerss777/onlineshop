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
Route::get('/getAdvertisementsByCategory/{id}', 'AdvertisementController@getAdvertisementsByCategory');


//User routes
Route::get('/my_account/{id}', 'UserController@show');
Route::get('/edit_account/{id}', 'UserController@edit');
Route::put('/update_account/{id}', 'UserController@update');


//Advertisement routes
Route::resource('advertisement', 'AdvertisementController');
Route::get('/getMyAdvertisements', 'AdvertisementController@myAdvertisements');
Route::post('/setIconImage', 'AdvertisementController@setIconImage');

Route::get('/test/{id}', 'AdvertisementController@index');


//Image routes
Route::post('/upload', ['as' => 'image.store' , 'uses' => 'ImageController@store']);
Route::get('/upload/{id}', ['as' => 'image.create' , 'uses' => 'ImageController@create']);
Route::get('/removeUpload/{id}', ['as' => 'image.removeUpload' , 'uses' => 'ImageController@removeUpload']);


