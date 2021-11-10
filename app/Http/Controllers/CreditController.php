<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\credit;
use App\transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CreditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('latest_credit')->where('role_id', '3')->where('status', '0');
        $ctrl = $this->generateControlNum();
        $expr = $this->generateExpirationNum();
        $transactions = transaction::where('control_no', $ctrl)->sum('price');

        
        $users = $users->paginate(10);
        return view('includes.table.creditTbl', compact('users','ctrl','expr'));
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
     * @param  \App\credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function show(credit $credit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function edit(credit $credit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, credit $credit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\credit  $credit
     * @return \Illuminate\Http\Response
     */
    public function destroy(credit $credit)
    {
        //
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
    function generateExpirationNum(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $ldate = Carbon::now()->format('t');
        $con = $month.'-'.$year;
        if ($day <= 15) {
            $con = '16-'.$con;
        } else {
            $con = $ldate.'-'.$month.'-'.$year;
        }
        
        
        return $con;
    }

}
