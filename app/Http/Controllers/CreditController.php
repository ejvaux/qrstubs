<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\credit;
use App\User;
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
        $ctrl = $this->generateControlNum();
        $users = User::where('role_id', 3)->where('status', 0)
            ->with(['credits' => function($q) use($ctrl){
                $q->where('credits.control_no', $ctrl);
            }, 
                    'transactions' => function($q) use($ctrl){
                $q->where('transactions.control_no', $ctrl);
            }]);

        $expr = $this->generateExpirationNum();
        
        $users = $users->orderBy('name')->paginate(10);
        // return view('includes.table.creditTbl', compact('users','ctrl','expr'));
        return view('includes.table.creditTbl', compact('users','expr'));
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

    public function updateAmount(Request $request)
    {
        $credit = credit::findOrFail($request->credit_id);
        $credit->amount = $request->amount;
        $credit->save(); 

        return 'success';
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
        }
        else{
           $con = Carbon::parse($ldate.'-'.$month.'-'.$year)->addDay()->format('d-m-Y');
        }

        return $con;
    }

    function generateExpirationNum2(){
        
        $day = Carbon::now()->format('d');
        $month = Carbon::now()->format('m');
        $newMonth = Carbon::now()->addMonth();
        $newMonth2 =  $newMonth->format('m');

        $year = Carbon::now()->format('Y');
        $newYear = Carbon::now()->addYear();
        $newYear2 =  $newYear->format('Y');
        
        if ($day <= 15) {
            $con = '16'.'-'.$month.'-'.$year;
        }
        else {
            if ($month == 12){
                $con = '01'.'-'.$newMonth2.'-'.$newYear2;
            }
            else{
                $con = '01'.'-'.$newMonth2.'-'.$year;
            }
        }
        
        return $con;
    }

}
