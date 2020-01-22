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

Route::get('/','AbonentController@index')->name('home');
//Route::get('/', 'HomeController@index')->name('home');

Route::get('/createabonent','AbonentController@create');
Route::post('/createabonent','AbonentController@store');
Route::post('/','AbonentController@index');
Route::get('/abonentsearch/{slug?}', 'AbonentController@show');
Route::post('/editabonent','AbonentController@edit');
Route::post('/updateabonent','AbonentController@update');



Route::post('/addoplata','OplataController@index');
Route::post('/addoplatacreate','OplataController@store');

Route::post('/addusluga','UslugaController@index');
Route::post('/adduslugacreate','UslugaController@store');

Route::get('/createstreettip','SettingsController@streettipcreateindex');
Route::post('/addstreettip','SettingsController@addstreettip');

Route::get('/editstreettip/{id}/edit','SettingsController@editstreettip');
Route::post('/updatestreettip','SettingsController@updatestreettip');
