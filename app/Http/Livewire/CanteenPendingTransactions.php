<?php

namespace App\Http\Livewire;

use Auth;
use Livewire\Component;
use App\Transaction;
use Illuminate\Support\Facades\Log;

class CanteenPendingTransactions extends Component
{
    public $transactions;
    public $user;
    public $user_id;

    public function mount()
    {
        $this->user = Auth::user();
        $this->user_id = $this->user->id;
        $this->transactions = $this->query()->where('scanner_id','=',$this->user->id)->pending()->get();
    }

    public function getListeners()
    {
        return [
            "echo-private:transaction.Canteen.{$this->user_id},TransactionPaid" => 'paidCanteenTransaction',
            "addCanteenTransaction",
            "cancelTransaction",
        ];
    }

    public function addCanteenTransaction($e)
    {
        $this->transactions->push($this->query()->where('id','=',$e['id'])->first());
    }

    public function paidCanteenTransaction($e)
    {
        $id = $e['transactions']['id'];
        $this->removeCanteenTransaction($id);
        $this->emit('notifyMessage','Transaction Paid','Transaction #'.$id.' paid.');
    }

    public function removeCanteenTransaction($e)
    {
        foreach ($this->transactions as $key => $value) {
            if($value['id'] == $e){
                $this->transactions->forget($key);
            }
        }
    }

    public function query()
    {
        return Transaction::with(['canteen'])->select('id','price','canteen_id','created_at')->withoutGlobalScopes();
    }

    public function cancelTransaction($transactionId)
    {
        $tr = Transaction::withoutGlobalScopes()->find($transactionId);
        $tr->update(['status' => 3]);
        $this->removeCanteenTransaction($transactionId);
        broadcast(new \App\Events\TransactionCancelled($tr));
        $this->emit('alertMessage','Transaction #'.$transactionId.' Cancelled.');
    }

    public function render()
    {
        return view('livewire.pending-transactions');
    }
}
