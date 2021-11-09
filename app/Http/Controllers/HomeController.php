<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\credit;
use App\Role;
use App\Department;
use App\transaction;
use App\canteen;
use Auth;
use Carbon\Carbon;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function pages()
    {
        if((Auth::user()->role_id==1)){
            return redirect('hr');
        }
        elseif((Auth::user()->role_id==2))
        {
            return redirect('canteen');
        }
        elseif((Auth::user()->role_id==3))
        {
            return redirect('user');
        }
    }
    public function hr(Request $req)
    {
        $departments = Department::all();
        
        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('pages.hr.hr-home',compact('departments'));
        } else {
            return redirect('error');
        }
    }
    public function canteen(Request $req)
    {
        if (Auth::check() && Auth::user()->role_id == 2) {
            return view('pages.canteen.ctn-home');
        } else {
            return redirect('error');
        }
    }
    public function user(Request $req)
    {
        $users = Auth::user()->id;
        $uname = Auth::user()->uname;
        $qrcode = Auth::user()->qrcode;
        $ctrl = $this->generateControlNum();
        $credit = Credit::where('user_id',$users)->where('control_no',$ctrl)->first();
        if($credit == NULL){
            $balance = '"Please apply for your Credit Amount"';
            $qrcode = '"Please apply for your Credit Amount"';
        } else {
            $price_total = Transaction::where('user_id',$users)->where('credit_id',$credit->id)->sum('price');
            $balance = $credit->amount - $price_total;
        }
        

        if (Auth::check() && Auth::user()->role_id == 3) {
            return view('pages.user.user-home', compact('qrcode','balance', 'uname'));
        } else {
            return redirect('error');
        }
    }
    public function usrtransact(Request $req)
    {
        if (Auth::check() && Auth::user()->role_id == 3) {
            return view('pages.user.user-transaction');
        } else {
            return redirect('error');
        }
    }
    public function ctntransact(Request $req)
    {
        if (Auth::check() && Auth::user()->role_id == 2) {
            return view('pages.canteen.ctn-transaction');
        } else {
            return redirect('error');
        }
    }
    public function error(Request $req)
    {
        return view('pages.error');
    }

    function generateControlNum(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $con = 'SPI'.$year.$month;
        if ($day <= 15) {
            $con = $con.'A';
        } else {
            $con = $con.'B';
        }
        return $con;
    }
}
