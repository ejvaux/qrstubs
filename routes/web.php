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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/*
    EJ - Start
*/
Route::get ('/print', 'PrintController@index');
Route::get ('/layout', 'PrintController@layout');

Route::get ('/emp', 'EmployeeController@index');
/*
    EJ - End
*/

// TEST
Route::get('/students','PrintController@index2');
Route::get('/prnpreview','PrintController@prnpriview');
// TEST