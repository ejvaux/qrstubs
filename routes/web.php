<?php

use App\Exports\RequestsExport;
use Maatwebsite\Excel\Facades\Excel;
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

// Pages
Route::get('/', 'HomeController@pages');
Route::get('/home', 'HomeController@pages')->name('home');


// Pages
Route::get('/hr', 'HomeController@hr');
Route::get('/canteen', 'HomeController@canteen');
Route::get('/user', 'HomeController@user');
Route::get('/usrtransact', 'HomeController@usrtransact');
Route::get('/ctntransact', 'HomeController@ctntransact');
Route::get('/error', 'HomeController@error');
Route::get('/password', 'HomeController@password');

//Get Resources of Controller
Route::resources([
    'hrc' => 'HrController',
    'ctn' => 'CanteenController',
    'usrtrct' => 'TransactionController',
    'crdc' => 'CreditController',
]);

// HR Registration
Route::post('registerUser', 'HrController@store');
Route::post('updateAmount', 'HrController@updateAmount');


// EXPORTING
Route::get('export/usercredits', 'ExportController@exportCredit');


/*
    EJ - Start
*/
Route::get ('/print', 'PrintController@index');
Route::get ('/layout', 'PrintController@layout');

Route::get ('/emp', 'EmployeeController@index');
Route::get ('/ctform', 'EmployeeController@cntn');

Route::post ('/getuser', 'UserController@getUser');
Route::post ('/getUserCredit', 'UserController@getUserCredit');
Route::post ('/transact', 'TransactionController@transact');

Route::get ('/export/user/page', 'ExportController@userExportPage');
Route::get ('/export/user/download', 'ExportController@userDownload');
Route::get ('/export/user/modal', 'ExportController@userModal');
Route::get ('/export/transaction/download', 'ExportController@transactionDownload');

Route::get ('/test', 'TestController@index');
Route::get ('/importuser', 'ImportController@importUser');

/*
    EJ - End
*/

// TEST
Route::get('/students','PrintController@index2');
Route::get('/prnpreview','PrintController@prnpriview');
// TEST

