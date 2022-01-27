<?php

namespace App\Listeners;

use App\Events\TransactionPaymentRequest;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendTransactionPendinNotification
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
     * @param  TransactionPaymentRequest  $event
     * @return void
     */
    public function handle(TransactionPaymentRequest $event)
    {
        //
    }
}
