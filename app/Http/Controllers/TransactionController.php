<?php

namespace App\Http\Controllers;

use App\Transaction;
use App\Credit;
use Auth;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(transaction $transaction)
    {
        //
    }

    public function transact(Request $request)
    {
        /*$request->userId."-".$request->ctrl."-".$request->amount;*/
        $credit = Credit::where('user_id',$request->userId)->where('control_no',$request->ctrl)->first();
        if ($credit) {
            $tAmount = Transaction::where('user_id',$request->userId)->where('credit_id',$credit->id)->sum('price');
            $bal = $credit->credit_amount - $tAmount;

            if ($bal > $request->amount) {
                $tr = new Transaction;
                $tr->user_id = $request->userId;
                $tr->credit_id = $credit->id;
                $tr->control_no = $request->ctrl;
                $tr->canteen_id = Auth::id();
                $tr->price = $request->amount;

                if ($tr->save()) {
                    return [
                        'status' => 1,
                        'result' => 'Transaction Complete.'
                    ];
                }
                else {
                    return [
                        'status' => 2,
                        'result' => 'Transaction Failed'
                    ];
                }

            } else {
                return [
                    'status' => 2,
                    'result' => "Not enough credit balance."
                ];
            }
        }
        else{
            return [
                'status' => 2,
                'result' => "No credit found."
            ];
        }
    }
}
