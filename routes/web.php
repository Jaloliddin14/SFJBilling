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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/','AbonentController@index')->name('home');
//Route::get('/', 'HomeController@index')->name('home');

Route::get('/createabonent','AbonentController@create');

Route::post('/createabonent','AbonentController@store');

Route::post('/','AbonentController@index');

Route::get('/abonentsearch/{slug?}', 'AbonentController@show');

Route::post('/','AbonentController@index');


Route::get('/addoplata/{id?}','OplataController@show');

