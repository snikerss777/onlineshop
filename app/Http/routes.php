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

Route::get('/user/login', 'UserController@authUser');

//angular routes

Route::get('/getCategories/{id}', 'CategoryController@index');
Route::get('/getEditCategories/{id}', 'CategoryController@getEditCategories');
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
Route::get('/advertisement/edit/{id}', ['as' => 'advertisement/edit/' , 'uses' => 'AdvertisementController@edit']);
Route::get('/advertisement/destroy/{id}', ['as' => 'advertisement/destroy/' , 'uses' => 'AdvertisementController@destroy']);


Route::get('/test/{id}', 'AdvertisementController@index');


//Image routes
Route::post('/upload', ['as' => 'image.store' , 'uses' => 'ImageController@store']);
Route::get('/upload/{id}', ['as' => 'upload/' , 'uses' => 'ImageController@create']);
Route::get('/removeUpload/{id}', ['as' => 'image.removeUpload' , 'uses' => 'ImageController@removeUpload']);


//Transaction routes
// Route::get('/transaction/done', 'TransactionController@doneDeals');
Route::get('/transaction/{id}', 'TransactionController@show');
Route::get('/userTransactions/{id}', 'TransactionController@userTransactions');
Route::get('/admin/transactions', 'TransactionController@adminTransactions');
Route::get('/archive/transactions', 'TransactionController@archiveTransactions');
Route::get('/userProducts/{id}', 'TransactionController@userProducts');
Route::get('/transaction/remove/{id}', 'TransactionController@remove');
Route::get('/transaction/changeStatus/{id}/{statusId}', 'TransactionController@changeStatus');



// Route::get('/acceptTransaction/{id}', 'TransactionController@acceptTransaction');
Route::post('/transaction', ['as' => 'transaction.store' , 'uses' => 'TransactionController@store']);
// Route::get('/goToAdvertisement', ['as' => 'transaction.goToAdvertisement' , 'uses' => 'AdvertisementController@index']);

Route::get('goToAdvertisement/{id}', array('as' => 'goToAdvertisement/', 'uses' => 'AdvertisementController@show'));


//Observed Advertisements routes
Route::get('/getObservedAdvertisements', 'ObservedAdvertisementController@index');
Route::get('/observedAdvertisement/store/{id}', 'ObservedAdvertisementController@store');
Route::get('/observedAdvertisement/delete/{id}', 'ObservedAdvertisementController@destroy');




//Bracket Routes
Route::get('/bracket/{id}', 'BracketController@show');
Route::get('/bracket', 'BracketController@index');
Route::get('/bracket/remove/{id}', 'BracketController@removeProduct');
Route::post('/bracket/postBracket', 'BracketController@postBracket');