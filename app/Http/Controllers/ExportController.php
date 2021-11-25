<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Credit;
use App\Exports\UsersExport;
use App\Exports\TransactionsExport;
use App\Exports\UsersCreditExport;
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
        return (new UsersExport($req->ctrl))->download('Employee Credits '.$req->ctrl.'.xlsx');
    }
    public function transactionDownload(Request $req)
    {
        return (new TransactionsExport($req->input('fromDate'),$req->input('toDate'),$req->input('canteenId')))->download('Transactions_'.Date('Ymd').'.xlsx');
    }
    public function exportCredit(Request $req)
    {
        return (new UsersCreditExport)->download("User's Credits.xlsx");
    }

    public function userModal()
    {
        $credits = Credit::orderBy('id','DESC')->get()->unique('control_no');
        return view('includes.modal.userExportModal',compact('credits'));
    }
}
