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
        $pdate = $this->generatePreviousDate();
        $cdate = $this->generateCurrentDate();
        $ctrl = $this->generateControlNum();
        $ctrl2 = $this->generatePrevControlNum();
        $ccanteen1 = Transaction::where('canteen_id', 1)->where('control_no',$ctrl)->sum('price');
        $ccanteen2 = Transaction::where('canteen_id',2)->where('control_no',$ctrl)->sum('price');
        $pcanteen1 = Transaction::where('canteen_id', 1)->where('control_no',$ctrl2)->sum('price');
        $pcanteen2 = Transaction::where('canteen_id',2)->where('control_no',$ctrl2)->sum('price');
        $ccredit = Credit::where('control_no',$ctrl)->sum('amount');
        $pcredit = Credit::where('control_no',$ctrl2)->sum('amount');
        $ctotal = $ccanteen1 + $ccanteen2;
        $ptotal = $pcanteen1 + $pcanteen2;
        if (Auth::check() && Auth::user()->role_id == 1) {
            return view('pages.hr.hr-home',compact('departments', 'ctrl', 'ctrl2', 'cdate', 'pdate', 'ccanteen1',
            'ccanteen2', 'pcanteen1','pcanteen2', 'ccredit', 'pcredit', 'ctotal', 'ptotal'));
        } else {
            return redirect('error');
        }
    }
    public function canteen(Request $req)
    {
        $canteen_id = Auth::user()->canteen_id;
        $ldate = $this->generatePreviousDate();
        $cdate = $this->generateCurrentDate();
        $ctrl = $this->generateControlNum();
        $ctrl2 = $this->generatePrevControlNum();
        $ctotal = Transaction::where('canteen_id',$canteen_id)->where('control_no',$ctrl)->sum('price');
        $ltotal= Transaction::where('canteen_id',$canteen_id)->where('control_no',$ctrl2)->sum('price');
        if($ltotal == NULL){
            $ltotal = '0';
        }
        if($ctotal == NULL){
            $ctotal = '0';
        }

        if (Auth::check() && Auth::user()->role_id == 2) {
            return view('pages.canteen.ctn-home', compact( 'cdate', 'ldate', 'ctrl2', 'ctrl', 'ctotal', 'ltotal'  ));
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
            $balance = '0';
            $qrcode = '0';
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
    public function faq(Request $req)
    {
        return view('pages.FAQ');
    }
    public function password(Request $req)
    {
        return view('changepass');
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

    function generatePrevControlNum(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $prevmonth = Carbon::now()->subMonth()->format('Ym');
        $day = Carbon::now()->format('d');
        $con = 'SPI'.$year.$month;

        // if($month == 1){
        //     $con = 'SPI'.$prevyear
        // }
        if ($day <= 15) {
            $con = 'SPI'.$prevmonth.'B';
        } else {
            $con = $con.'A';
        }
        return $con;

    }

    function generateCurrentDate(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $ldate = Carbon::now()->format('t');
        $con = $month.'/'.$year;

        if ($day <= 15) {
            $con1 = '01/'.$con;
        } else {
            $con1 = '16/'.$con;
        }
        if ($day <= 15) {
            $con2 = '15/'.$con;
        } else {
            $con2 = $ldate.'/'.$con;
        }

        $con = $con1.' ~ '.$con2;

        return $con;
    }

    function generatePreviousDate(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $lastMonth =  Carbon::now()->subMonth()->format('m/Y');
        $lastDayofPreviousMonth = Carbon::now()->subMonthNoOverflow()->endOfMonth()->format('d/m/Y');

        $con = $month.'/'.$year;

        // if($month == 1){
        //     if ($day <= 15) {
        //         $con1 = '16/'.$lastMonth.'/'.$lastYear;
        //     } else {
        //         $con1 = '01/'.$con;
        //     }
        // }
        // else{

        // }

        if ($day <= 15) {
            $con1 = '16/'.$lastMonth;
        } else {
            $con1 = '01/'.$con;
        }

        if ($day <= 15) {
            $con2 = $lastDayofPreviousMonth;
        } else {
            $con2 = '15/'.$con;
        }


        $con = $con1.' ~ '.$con2;

        return $con;
    }
}

