<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\TransactionPaymentRequest' => [],
        'App\Events\TransactionPaid' => [],
        'App\Events\TransactionCancelled' => [],
        /*'App\Events\TransactionPaymentRequest' => [
            'App\Listeners\SendTransactionPendinNotification',
        ],
        'App\Events\TransactionPaid' => [
            'App\Listeners\SendTransactionCompleteNotification',
        ],*/
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
