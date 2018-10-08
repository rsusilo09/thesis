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

Route::get('order', 'mainController@order');
Route::get('cooking', 'mainController@cook');
Route::get('bills', 'mainController@bills');

Route::post('pesan', ['as'=>'pesan', 'uses'=>'mainController@pesan']);

Route::get('doneCook/{a}', ['uses'=>'mainController@doneCook', 'as' => 'doneCook']);

Route::get('pay/{a}', ['uses'=>'mainController@pay', 'as' => 'pay']);

Route::get('paid/{meja}', ['as'=>'paid', 'uses'=>'mainController@paid']);
