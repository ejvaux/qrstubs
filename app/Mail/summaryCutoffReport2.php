<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Credit;
use App\Canteen;
use App\Transaction;
use Carbon\Carbon;

class summaryCutoffReport2 extends Mailable
{
    use Queueable, SerializesModels;

    // protected $ctns;
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
        $tctn1 =Transaction::where('canteen_id', 1)->where('control_no',$ctrl)->sum('price');
        $tctn2 = Transaction::where('canteen_id',2)->where('control_no',$ctrl)->sum('price');
        $ldate = $this->generatePreviousDate();
        $toverall = $tctn1 + $tctn2;
        $tcredit = Credit::where('control_no',$ctrl)->sum('amount');
        return $this->markdown('emails.summaryCutoffReport2')
                    ->subject('Sercomm Meal Allowance Summary Report')
                    ->attachFromStorageDisk('public',$this->path)
                    ->bcc('lawrence_bondad@sercomm.com')
                    ->with([
                        // 'ctns' => $ctns,
                        'from' => $fd_from,
                        'to' => $fd_to,
                        'tcredit' => $tcredit,
                        'tctn1' => $tctn1,
                        'tctn2' => $tctn2,
                        'ldate' => $ldate,
                        'toverall' => $toverall,
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
    function generatePreviousDate(){
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $day = Carbon::now()->format('d');
        $lastMonth =  Carbon::now()->subMonth()->format('m/Y');
        $lastDayofPreviousMonth = Carbon::now()->subMonthNoOverflow()->endOfMonth()->format('d/m/Y');

        $con = $month.'/'.$year;
        

        if ($day <= 15) {
            $con1 = '16/'.$lastMonth;
        } else {
            $con1 = '01/'.$con;
        }
        
        if ($day <= 15) {
            $con2 = $lastDayofPreviousMonth;
        } else {
            $con2 = '15/'.$con;
        }


        $con = $con1.' ~ '.$con2;

        return $con;
    }
}
