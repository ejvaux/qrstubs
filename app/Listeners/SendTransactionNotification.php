<?php

namespace App\Listeners;

use App\Events\TransactionPaid;
use App\Events\TransactionPaymentRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTransactionNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  TransactionPaid  $event
     * @return void
     */
    public function handle(TransactionPaid $event)
    {
        //
    }
}
