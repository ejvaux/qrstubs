<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\credit;
use App\Role;
use App\Department;
use App\canteen;
use App\transaction;
use Auth;
use Carbon\Carbon;

class UserController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = Auth::user()->id;

        //Don't forget pagination when displaying table
        $transactions = transaction::where('user_id', 'like', $users)
                    ->orderBy('id', 'DESC')->take(3)->get();
        if (Auth::check() && Auth::user()->role_id == 3) {
            return view('includes.table.user2Tbl', compact('transactions'));
        } else {
            return redirect('error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getUser(Request $request)
    {
        $user = User::with('department')->where('qrcode',$request->qr)->where('status',0)->first();
        return $user;
    }

    public function getUserCredit(Request $request)
    {
        $credit = Credit::where('user_id',$request->userId)->where('control_no',$request->ctrl)->first();
        return $credit;
    }
    public function getNewQr(Request $request)
    {
        $qrdte = Carbon::now();
        $qrnew = 'SPO'.$request->username.$qrdte;
        $hashedqr = Hash::make($qrnew);

        $user = User::findOrFail($request->employee_id);
        $user->qrcode = $hashedqr;
        $user->save();

        return 'success';
    }

    // function generateNewQR(){
    //     $year = Carbon::now()->format('Y');
    //     $month = Carbon::now()->format('m');
    //     $day = Carbon::now()->format('d');
    //     $hour= Carbon::now()->format('H');
    //     $min= Carbon::now()->format('i');
    //     $sec= Carbon::now()->format('s');

    //     $con = $year.$month.$day;

    //     return $con;
    // }
}
