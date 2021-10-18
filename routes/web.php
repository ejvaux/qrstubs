<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
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


// Void the Built in Register button
Auth::routes(['register' => false]);

// Auth::routes();
Route::get('/', 'HomeController@pages');
Route::get('/home', 'HomeController@index')->name('home');



// Pages
Route::get('/hr', 'HomeController@hr');
Route::get('/canteen', 'HomeController@canteen');
Route::get('/user', 'HomeController@user');

/*
    EJ - Start
*/
Route::get ('/print', 'PrintController@index');
Route::get ('/layout', 'PrintController@layout');

Route::get ('/emp', 'EmployeeController@index');
Route::get ('/cntnform', 'EmployeeController@cntn');

/*
    EJ - End
*/

// TEST
Route::get('/students','PrintController@index2');
Route::get('/prnpreview','PrintController@prnpriview');
// TEST

