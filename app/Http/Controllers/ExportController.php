<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Exports\UsersExport;
use App\Exports\TransactionsExport;
use Carbon\Carbon;
//use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
       HR
    */
    public function userExportPage(Request $req)
    {
        if (Auth::user()->role_id == 1) {
            return view('pages.export.hrExport');
        } else {
            return "Restricted Access.";
        }
    }

    public function userDownload(Request $req)
    {
        //return Excel::download(new UsersExport, 'Employee Credits.xlsx');
        return (new UsersExport)->download('Employee Credits.xlsx');
    }
    public function transactionDownload(Request $req)
    {
        return (new TransactionsExport($req->date,$req->canteenId))->download('Transcations_'.Date('Ymd').'.xlsx');
    }
}
