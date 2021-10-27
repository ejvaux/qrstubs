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
//Welcome
// Route::get('/', function () {
//     return view('welcome');
// });


// Hide the Built in Register button (Admin)
// Auth::routes(['register' => false]);

//Show the Auth
Auth::routes();

Route::get('/', 'HomeController@pages');
Route::get('/home', 'HomeController@index')->name('home');


// Pages
Route::get('/hr', 'HomeController@hr');
Route::get('/canteen', 'HomeController@canteen');
Route::get('/user', 'HomeController@user');
Route::get('/usrtransact', 'HomeController@usrtransact');
Route::get('/ctntransact', 'HomeController@ctntransact');

Route::resources([
    'users' => 'UserController',
    'credits' => 'CreditController',
    'usrtrct' => 'TransactionController',

]);

// HR Registration
Route::post('registerUser', 'UserController@store');
/*
    EJ - Start
*/
Route::get ('/print', 'PrintController@index');
Route::get ('/layout', 'PrintController@layout');

Route::get ('/emp', 'EmployeeController@index');
Route::get ('/ctform', 'EmployeeController@cntn');

Route::get ('/getuser/{qr}', 'UserController@getUser');
Route::post ('/getUserCredit', 'UserController@getUserCredit');
Route::post ('/transact', 'TransactionController@transact');

/*
    EJ - End
*/

// TEST
Route::get('/students','PrintController@index2');
Route::get('/prnpreview','PrintController@prnpriview');
// TEST

