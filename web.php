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

// Example Routes

Route::view('/testpage', 'testpage');
//Route::view('/dashboard', 'dashboard');
Route::view('/examples/plugin', 'examples.plugin');
Route::view('/examples/blank', 'examples.blank');

Auth::routes();


Route::group(['middleware'=>'auth'], function() {
  Route::resource('dashboard/gosti', 'PozivniceController', ['names' => [
      'index'=>'gosti.index',
      'show' => 'gosti.show',
      'create'=>'gosti.create',
      'edit'=>'gosti.edit'
    ]]);

    Route::get('gosti/{id}/send','PozivniceController@send')->name('pozivnice.send');
    Route::get('gosti/{id}/send','PozivniceController@send')->name('pozivnice.send');
    Route::get('gosti/send','PozivniceController@sendAll')->name('pozivnice.sendAll');
    Route::get('dashboard/potvrdeni','PozivniceController@potvrdeni')->name('pozivnice.potvrdeni');
    Route::get('dashboard/odbijeni','PozivniceController@odbijeni')->name('pozivnice.odbijeni');
    Route::get('dashboard/nacekanju','PozivniceController@nacekanju')->name('pozivnice.nacekanju');
});

Route::get('dashboard/gosti/{id}/{action}', 'AcceptController@reject')->name('pozivnice-reject');
Route::get('/odgovor/{id}','AcceptController@accept')->name('pozivnice-accept');
Route::post('/odgovor/{id}/accept', 'AcceptController@odgovor_poslan')->name('odgovor_poslan');

Route::get('/dashboard', 'AdminController@admin')
    ->middleware('is_admin')
    ->name('dashboard');

Route::get('/home', 'HomeController@index')->name('home');

Route::view('/', 'sweetie')->name('sweetie');
