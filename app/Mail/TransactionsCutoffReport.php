<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Canteen;
use Carbon\Carbon;

class TransactionsCutoffReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $ctns;
    protected $path;
    protected $date_from;
    protected $date_to;
    protected $canteenId;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $path, $date_from, $date_to, $canteenId = null)
    {
        $this->path = $path;
        $this->date_from = Carbon::parse($date_from)->format('Y-m-d 00:00:00');
        $this->date_to = Carbon::parse($date_to)->format('Y-m-d 23:59:59');
        $this->canteenId = $canteenId;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $fd_from = Carbon::parse($this->date_from)->format('F d, Y');
        $fd_to = Carbon::parse($this->date_to)->format('F d, Y');
        $ctns = Canteen::withCount(['transactions as transactions_sum' => function($query) {
            $query->select(\DB::raw('sum(price)'))
                ->whereBetween('created_at', [$this->date_from, $this->date_to]);
        }]);
        if($this->canteenId){
            $ctns = $ctns->where('id','=',$this->canteenId);
        }
        $ctns = $ctns->get();
        return $this->markdown('emails.transactionCutoffReport')
                    ->subject('Sercomm Meal Allowance Cutoff Summary Report for '.$fd_from.'-'.$fd_to)
                    ->attachFromStorageDisk('public',$this->path)
                    ->with([
                        'ctns' => $ctns,
                        'from' => $fd_from,
                        'to' => $fd_to,
                    ]);
    }
}
