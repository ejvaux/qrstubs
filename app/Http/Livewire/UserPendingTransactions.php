<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use App\Transaction;
use Illuminate\Support\Facades\Log;
use App\CustomFunctions;
use App\Traits\TransactionTraits;

class UserPendingTransactions extends Component
{
    use TransactionTraits;

    public $transactions;
    public $user;
    public $user_id;

    public function mount()
    {
        $this->user = Auth::user();
        $this->user_id = $this->user->id;
        $this->transactions = Transaction::withoutGlobalScopes()->where('user_id','=',$this->user->id)->pending()->get();
    }

    public function getListeners()
    {
        return [
            "echo-private:transaction.User.{$this->user_id},TransactionPaymentRequest" => 'addUserTransaction',
            "echo-private:transaction.User.{$this->user_id},TransactionCancelled" => 'cancelUserTransaction',
            "acceptTransaction",
            "getBalance",
            "checkPendingTransactions",
        ];
    }
    public function addUserTransaction($e)
    {
        $this->transactions->push(Transaction::withoutGlobalScopes()->where('id','=',$e['transactions']['id'])->first());
        $this->getBalance();
        $this->emit('notifyMessage','New Transaction Request','Transaction #'.$e['transactions']['id'].' received.');
        $this->checkPendingTransactions();
    }

    public function cancelUserTransaction($e)
    {
        $id = $e['transactions']['id'];
        $this->removeUserTransaction($id);
        //$this->checkPendingTransactions();
        $this->getBalance();
        $this->emit('notifyMessage','Transaction Cancelled','Transaction #'.$id.' cancelled.');
        $this->checkPendingTransactions();
    }

    public function removeUserTransaction($e)
    {
        foreach ($this->transactions as $key => $value) {
            if($value['id'] == $e){
                $this->transactions->forget($key);
            }
        }
    }

    public function acceptTransaction($transactionId)
    {
        $tr = Transaction::withoutGlobalScopes()->find($transactionId);
        $tr->update(['status' => 2]);
        broadcast(new \App\Events\TransactionPaid($tr));
        $this->removeUserTransaction($transactionId);
        $this->getBalance();
        $this->checkPendingTransactions();
        $this->emit('getTransactionHistory');
        $this->emit('alertMessage','Transaction #'.$transactionId.' Accepted.');
    }

    public function getBalance()
    {
        $ctrl = CustomFunctions::generateControlNum();
        $credit = \App\Credit::where('user_id',$this->user->id)->where('control_no',$ctrl)->first();
        if($credit == NULL){
            $balance = NULL;
        } else {
            $price_total = Transaction::where('user_id',$this->user->id)->where('credit_id',$credit->id)->sum('price');
            $pending = Transaction::withoutGlobalScopes()
                                    ->where('user_id',$this->user->id)
                                    ->where('credit_id',$credit->id)
                                    ->pending()
                                    ->sum('price');
            $balance = [
                "total" => $credit->amount - $price_total - $pending,
                "completed" => $price_total,
                "pending" => $pending,
                "credit" => $credit->amount,
            ];
        };
        $this->emit('updateBalance',$balance);
    }

    public function checkPendingTransactions()
    {
        $condition = false;

        if ($this->transactions->count() > 0 && !$this->isGuest($this->user_id)) {
            $condition = true;
        }

        $this->emit('hasPending',$condition);
    }

    public function render()
    {
        return view('livewire.pending-transactions');
    }
}
