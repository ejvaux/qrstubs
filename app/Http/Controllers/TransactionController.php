<?php

namespace App\Http\Controllers;

use Auth;
use App\Transaction;
use App\Credit;
use App\User;
use Carbon\Carbon;
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
        $users = Auth::user()->id;

        //Don't forget pagination when displaying table
        $transactions = transaction::where('user_id', 'like', $users)
                    ->orderBy('id', 'DESC')->paginate(10);

        return view('includes.table.userTbl', compact('transactions'));
    }
    public function home()
    {
        $user_id = Auth::user()->id;
        $qrcode = Auth::user()->qrcode;
        $control_no = 'SP202110B';
        //Get Date today
        $todayDate = Carbon::now()->format('Y-m');
        dd($todayDate);

        //Credit amount of User
        $credit = credit::select('credit_amount')->where('user_id', 'like', $user_id)
                    ->where('control_no', 'like', $control_no);
        //Transactions of User
        $price = transaction::select('price')->where('user_id', 'like', $user_id)
                    ->where('control_no', 'like', $control_no);
        //Computation of User
        $balance = 'hello';

        return view('pages.user.user-home', compact('qrcode'));
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