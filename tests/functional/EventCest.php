<?php

use Illuminate\Support\Facades\Event;
use App\Events\TransactionCancelled;
use App\Events\TransactionPaid;
use App\Events\TransactionPaymentRequest;

class EventCest
{
    public function _before(FunctionalTester $I)
    {
    }

    // tests
    public function TransactionCancelledTest(FunctionalTester $I)
    {
        Event::fake();

        broadcast(new TransactionCancelled([]));

        Event::assertDispatched(TransactionCancelled::class);
    }

    public function TransactionPaidTest(FunctionalTester $I)
    {
        Event::fake();

        broadcast(new TransactionPaid([]));

        Event::assertDispatched(TransactionPaid::class);
    }

    public function TransactionPaymentRequestTest(FunctionalTester $I)
    {
        Event::fake();

        broadcast(new TransactionPaymentRequest(new \App\Transaction()));

        Event::assertDispatched(TransactionPaymentRequest::class);
    }
}
