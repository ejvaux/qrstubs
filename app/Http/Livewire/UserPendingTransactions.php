<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use App\Transaction;
use Illuminate\Support\Facades\Log;

class UserPendingTransactions extends Component
{
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
        ];
    }
    public function addUserTransaction($e)
    {
        $this->transactions->push(Transaction::withoutGlobalScopes()->where('id','=',$e['transactions']['id'])->first());
        $this->emit('notifyMessage','New Transaction Request','Transaction #'.$e['transactions']['id'].' received.');
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

    public function acceptTransaction($transactionId)
    {
        $tr = Transaction::withoutGlobalScopes()->find($transactionId);
        $tr->update(['status' => 2]);
        broadcast(new \App\Events\TransactionPaid($tr));
        $this->removeUserTransaction($transactionId);
        $this->emit('alertMessage','Transaction #'.$transactionId.' Accepted.');
    }

    public function render()
    {
        return view('livewire.pending-transactions');
    }
}
