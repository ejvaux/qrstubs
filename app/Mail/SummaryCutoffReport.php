<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Credit;
use App\Canteen;
use Carbon\Carbon;

class SummaryCutoffReport extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $ctns;
    protected $path;
    protected $date_from;
    protected $date_to;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($path, $date_from, $date_to)
    {
        $this->path = $path;
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $ctrl = $this->generatePrevControlNum();
        $fd_from = Carbon::parse($this->date_from)->format('F d, Y');
        $fd_to = Carbon::parse($this->date_to)->format('F d, Y');
        $tcredit = Credit::where('control_no',$ctrl)->sum('amount');
        $ctns = Canteen::withCount(['transactions as transactions_sum' => function($query) {
            $query->select(\DB::raw('sum(price)'))
                ->whereBetween('created_at', [$this->date_from, Carbon::parse($this->date_to)->addDay()]);
        }])->get();
        return $this->markdown('emails.summaryCutoffReport')
                    ->subject('Sercomm Meal Allowance Summary Report')
                    ->attachFromStorageDisk('public',$this->path)
                    ->bcc('lawrence_bondad@sercomm.com')
                    ->with([
                        'ctns' => $ctns,
                        'from' => $fd_from,
                        'to' => $fd_to,
                        'tcredit' => $tcredit,
                    ]);
    }
    function generatePrevControlNum(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $prevmonth = Carbon::now()->subMonth()->format('Ym');
        $day = Carbon::now()->format('d');
        $con = 'SPI'.$year.$month;

        // if($month == 1){
        //     $con = 'SPI'.$prevyear
        // }
        if ($day <= 15) {
            $con = 'SPI'.$prevmonth.'B';
        } else {
            $con = $con.'A';
        }
        return $con;

    }
}
