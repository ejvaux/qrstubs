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
                    ->orderBy('id', 'DESC')->paginate(10);
        if (Auth::check() && Auth::user()->role_id == 3) {
            return view('includes.table.userTbl', compact('transactions'));
        } else {
            return redirect('error');
        }


    }
    public function home()
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
        $request->validate([
            'amount' => 'integer|min:0',
        ]);

        // Check pending transactions
        if ($this->checkPendingTransactions($request->userId)) {
            return [
                'status' => 2,
                'result' => "Please ask the employee to confirm the Pending Transactions first."
            ];
        }

        // Get credit
        $credit = $this->getCredit($request->userId,$request->ctrl);

        // get user balance credit - pending - completed
        $balance = $this->getBalance($request->userId,$request->ctrl);

        if($balance < $request->amount){
            return [
                'status' => 2,
                'result' => "Not enough credit balance."
            ];
        }

        $tr = new Transaction;
        $tr->user_id = $request->userId;
        $tr->scanner_id = Auth::id();
        $tr->credit_id = $credit->id;
        $tr->control_no = $request->ctrl;
        $tr->canteen_id = Auth::user()->canteen_id;
        $tr->price = $request->amount;
        $tr->save();
        broadcast(new \App\Events\TransactionPaymentRequest($tr));
        return [
            'status' => 1,
            'result' => 'Transaction Request Sent.',
            'transaction' => $tr
        ];
    }

    public function getBalance($user_id, $control_no)
    {
        $credit = Credit::where('user_id',$user_id)->where('control_no',$control_no)->first();
        $used = Transaction::withoutGlobalScopes()
                ->where('user_id',$user_id)
                ->where('credit_id',$credit->id)
                ->used()
                ->sum('price');
        $balance = $credit->amount - $used;
        return $balance;
    }

    public function getCredit($user_id, $control_no)
    {
        $credit = Credit::where('user_id',$user_id)->where('control_no',$control_no)->first();
        if(!$credit){
            abort(404,'Credit does not exist.');
        }
        else {
            return $credit;
        }
    }

    public function checkPendingTransactions($user_id)
    {
        $pending = Transaction::withoutGlobalScopes()
                ->where('user_id',$user_id)
                ->pending()
                ->first();
        if ($pending) {
            return true;
        }
    }
}
