<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use App\Transaction;
use Illuminate\Support\Facades\Log;
use App\CustomFunctions;

class UserPendingTransactions extends Component
{
    public $transactions;
    public $user;
    public $user_id;

    public function mount()
    {
        $this->user = Auth::user();
        $this->user_id = $this->user->id;
        $this->loadTransactions();
    }

    public function getListeners()
    {
        return [
            "echo-private:transaction.User.{$this->user_id},TransactionPaymentRequest" => 'addUserTransaction',
            "echo-private:transaction.User.{$this->user_id},TransactionCancelled" => 'cancelUserTransaction',
            "confirmTransaction",
            "confirmAllTransaction",
        ];
    }
    public function addUserTransaction($e)
    {
        $id = $e['transactions']['id'];
        $this->transactions->push(Transaction::withoutGlobalScopes()->where('id','=',$id)->first());
        $this->emit('notifyMessage','New Transaction Request','Transaction #'.$id.' received.');
        $this->emit('focusTransaction',$id);
    }

    public function cancelUserTransaction($e)
    {
        $id = $e['transactions']['id'];
        $this->removeUserTransaction($id);
        $this->emit('notifyMessage','Transaction Cancelled','Transaction #'.$id.' cancelled.');
    }

    public function removeUserTransaction($e)
    {
        foreach ($this->transactions as $key => $value) {
            if($value['id'] == $e){
                $this->transactions->forget($key);
            }
        }
    }

    public function confirmTransaction($transactionId)
    {
        $tr = Transaction::withoutGlobalScopes()->find($transactionId);
        $tr->update(['status' => 2]);
        broadcast(new \App\Events\TransactionPaid($tr));
        $this->removeUserTransaction($transactionId);
        $this->getBalance();
        $this->emit('getTransactionHistory');
        $this->emit('alertMessage','Transaction #'.$transactionId.' Accepted.');
    }

    public function confirmAllTransaction()
    {
        $trs = Transaction::withoutGlobalScopes()->where('user_id','=',$this->user->id)->pending()->get();
        Transaction::withoutGlobalScopes()->where('user_id','=',$this->user->id)->pending()->update(['status' => 2]);
        Log::info(json_encode($trs));
        $this->loadTransactions();
        foreach ($trs as $tr) {
            broadcast(new \App\Events\TransactionPaid($tr));
        }
        $this->getBalance();
        $this->emit('getTransactionHistory');
        $this->emit('alertMessage','All Transactions Accepted.');
    }

    public function getBalance()
    {
        $ctrl = CustomFunctions::generateControlNum();
        $credit = \App\Credit::where('user_id',$this->user->id)->where('control_no',$ctrl)->first();
        if($credit == NULL){
            $balance = '0';
            $qrcode = '0';
        } else {
            $price_total = Transaction::where('user_id',$this->user->id)->where('credit_id',$credit->id)->sum('price');
            $balance = $credit->amount - $price_total;
        };
        $this->emit('updateBalance',$balance);
    }

    public function loadTransactions()
    {
        $this->transactions = Transaction::withoutGlobalScopes()->where('user_id','=',$this->user->id)->pending()->get();
    }

    public function render()
    {
        return view('livewire.pending-transactions');
    }
}
