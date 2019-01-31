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

Route::get('/', function () {
    return view('welcome');
});

Route::post('login', ['uses'=>'mainController@login', 'as'=>'login']);
Route::get('logout', ['uses'=>'mainController@signOut', 'as'=>'logout']);
Route::get('pay/{restaurant_id}/{account_id}', ['uses'=>'mainController@pay', 'as' => 'pay']);
Route::get('paid/{restaurant_id}/{account_id}', ['as'=>'paid', 'uses'=>'mainController@paid']);

// User Routes
Route::get('userHome', ['uses'=>'mainController@userHome', 'as'=>'userHome']);
Route::get('menu/{restaurant_id}', 'mainController@getMenu');
Route::post('pesan', ['as'=>'pesan', 'uses'=>'mainController@pesan']);

// Restaurant Routes
Route::get('restaurantHome', ['uses'=>'mainController@restaurantHome', 'as'=>'restaurantHome']);
Route::get('arrive/{account_id}', ['uses'=>'mainController@arrive', 'as'=>'arrive']);
Route::get('doneCook/{restaurant_id}/{account_id}/{id}', ['uses'=>'mainController@doneCook', 'as' => 'doneCook']);


