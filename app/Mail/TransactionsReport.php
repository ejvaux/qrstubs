<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TransactionsReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $name;
    protected $path;
    protected $date;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name, $path, $date)
    {
        $this->name = $name;
        $this->path = $path;
        $this->date = $date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.transactionReport')
                    ->subject('Sercomm Meal Allowance Transaction Report')
                    ->attachFromStorageDisk('public',$this->path)
                    ->bcc('edmund_mati@sercomm.com')
                    ->with([
                        'name' => $this->name,
                        'date' => $this->date,
                    ]);
    }
}