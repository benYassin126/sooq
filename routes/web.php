<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can form web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Try Controller
Route::get('/try','TryController@index')->name('try');
Route::get('/try/form1', 'TryController@createStep1');
Route::post('/try/form1', 'TryController@PostcreateStep1');
Route::get('/try/form2', 'TryController@createStep2');
Route::post('/try/form2', 'TryController@PostcreateStep2');
Route::get('/try/form3', 'TryController@createStep3');
Route::post('/try/form3', 'TryController@PostcreateStep3');
Route::post('/try/store', 'TryController@store');
Route::get('/try/store', 'TryController@store');
