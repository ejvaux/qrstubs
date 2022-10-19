<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionCompleted extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $user;
    protected $transactions;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $transactions)
    {
        $this->user = $user;
        $this->transactions = $transactions;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.transactionCompleted')
                    ->subject('Pending Transactions status update')
                    ->bcc('edmund_mati@sercomm.com','francisco_habana@sercomm.com')
                    ->with([
                        'name' => $this->user->name,
                        'transactions' => $this->transactions,
                    ]);
    }
}
