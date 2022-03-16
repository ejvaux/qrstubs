<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Transaction;
use Illuminate\Support\Facades\Mail;
use App\Mail\TransactionCompleted;

class ConfirmTransactions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:confirm';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatic confirmation of all pending transactions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = \App\User::whereHas('transactions2', function ($query) {
            $query->pending();
        })
        ->with(['transactions2'=> function ($query) {
            $query->pending();
        }])
        ->get();
        $ids = $users->pluck('transactions2')->flatten(1)->pluck('id');
        Transaction::withoutGlobalScopes()
                        ->whereIn('id',$ids)
                        ->update(['status' => 2]);
        foreach ($users as $user) {
            if ($user->email) {
                Mail::to($user->email)
                    ->send(new TransactionCompleted($user,$user->transactions2));
            }
        }
    }
}
