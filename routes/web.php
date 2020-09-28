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
})->middleware('guest');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home/dwonloadAllImages', 'HomeController@dwonloadAllImages');
Route::get('home/fetch_image/{id}', 'HomeController@fetch_image');
//Try Controller
Route::get('/try','TryController@createStep1')->name('try');
Route::get('/try/form1', 'TryController@createStep1');
Route::post('/try/form1', 'TryController@PostcreateStep1');
Route::get('/try/form2', 'TryController@createStep2');
Route::post('/try/form2', 'TryController@PostcreateStep2');
Route::get('/try/form3', 'TryController@createStep3');
Route::post('/try/form3', 'TryController@PostcreateStep3');
Route::post('/try/form4', 'TryController@PostcreateStep4');
Route::post('/try.submit', 'TryController@submit')->name('try.submit');






Route::resource('imgs','UserImgsController');
Route::get('home/imgs/deleteAllImgs', 'UserImgsController@deleteAllImgs');
Route::get('home/imgs/fetch_image/{id}', 'UserImgsController@fetch_image');



Route::get('/profile', 'ProfileController@index')->name('profile');
Route::post('/profile', 'ProfileController@edit')->name('profile');


Route::get('/text', 'TextController@index')->name('text');
Route::post('/text/addPrices', 'TextController@addPrices');
Route::post('/text/add', 'TextController@add');
Route::post('/text/edit', 'TextController@edit');
Route::post('/text/delete', 'TextController@delete');
Route::get('home/text/fetch_image/{id}', 'TextController@fetch_image');
