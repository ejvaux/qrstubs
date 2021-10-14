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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/userpage', 'HomeController@userhome')->name('userhome');
/*
    EJ - Start
*/
Route::get ('/print', 'PrintController@index');
/*
    EJ - End
*/

// TEST
Route::get('/students','PrintController@index');
Route::get('/prnpreview','PrintController@prnpriview');
// TEST

