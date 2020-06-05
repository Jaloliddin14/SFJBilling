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

Route::get('/test','SettingsController@test');
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
Route::get('/closeusluga/{id}/close','UslugaController@edit');
Route::post('/docloseusluga','UslugaController@update');


Route::get('/createstreettip','SettingsController@streettipcreateindex');
Route::post('/addstreettip','SettingsController@addstreettip');
Route::get('/editstreettip/{id}/edit','SettingsController@editstreettip');
Route::post('/updatestreettip','SettingsController@updatestreettip');

Route::get('/createstreet','SettingsController@streetcreateindex');
Route::post('/addstreet','SettingsController@addstreet');
Route::get('/editstreet/{id}/edit','SettingsController@editstreet');
Route::post('/updatestreet','SettingsController@updatestreet');

Route::get('/createoplatatip','SettingsController@oplatatipcreateindex');
Route::post('/addoplatatip','SettingsController@addoplatatip');
Route::get('/editoplatatip/{id}/edit','SettingsController@editoplatatip');
Route::post('/updateoplatatip','SettingsController@updateoplatatip');

Route::get('/createservice','SettingsController@servicecreateindex');
Route::post('/addservice','SettingsController@addservice');
Route::get('/editservice/{id}/edit','SettingsController@editservice');
Route::post('/updateservice','SettingsController@updateservice');

Route::get('/createservicecena','SettingsController@servicecenacreateindex');
Route::get('/editservicecena/{id}/edit','SettingsController@editservicecena');
Route::post('/addservicecena','SettingsController@addservicecena');

Route::get('/createusers','SettingsController@userscreateindex');
Route::post('/addusers','SettingsController@addusers');
Route::get('/editusers/{id}/edit','SettingsController@editusers');
Route::post('/updateusers','SettingsController@updateusers');

Route::get('/closemonthpage','SettingsController@closemonthpage');
Route::post('/closemonthfunc','SettingsController@closemonthfunc');

Route::get('/saldooborot', function () { return view('Billing.reports.saldooborot',['payments'=>collect(),'periodex'=>collect()]);});
Route::post('/saldooborotget','ReportsController@getsaldooborot');
Route::post('/excelsaldooborotget','ReportsController@getexcelsaldooborot');

Route::get('/reestroplat', function () { return view('Billing.reports.reestroplat',['oplata'=>collect(),'periodot'=>collect(),'perioddo'=>collect()]);});
Route::post('/reestroplatget','ReportsController@getreestroplat');
Route::post('/excelreestroplatget','ReportsController@getexcelreestroplat');

Route::get('/reestrnach', function () { return view('Billing.reports.reestrnach',['payments'=>collect(),'periodex'=>collect()]);});
Route::post('/reestrnachget','ReportsController@getreestrnach');
Route::post('/excelreestrnachget','ReportsController@getexcelreestrnach');

Route::get('/postupleniye', function () { return view('Billing.reports.postupleniye',['payments'=>collect(),'periodex'=>collect()]);});
Route::post('/postupleniyeget','ReportsController@getpostupleniye');
Route::post('/excelpostupleniyeget','ReportsController@getexcelpostupleniye');

Route::get('/nachisleniye', function () { return view('Billing.reports.nachisleniye',['payments'=>collect(),'periodex'=>collect()]);});
Route::post('/nachisleniyeget','ReportsController@getnachisleniye');
Route::post('/excelnachisleniyeget','ReportsController@getexcelnachisleniye');

Route::get('/editrole/{id}/editrole','SettingsController@editusersrole');
Route::post('/updateusersrole','SettingsController@updateusersrole');
