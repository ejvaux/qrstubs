<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use App\Canteen;
use App\Transaction;
use App\EmailGroup;
use App\Exports\TransactionsExport;
use App\Exports\TransactionsCutOffExport;
use App\Mail\TransactionsReport;
use App\Mail\TransactionsCutoffReport;
use DB;

class TransactionsExportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'transaction:export {frequency}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending of transaction report.
                            {frequency: 1 = daily, 2 = end of cut-off}';

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
        $freq = $this->argument('frequency');
        if ($freq == 1) {
            $this->dailyReport();
        }
        elseif ($freq == 2) {
            $this->cutoffReport();
            $this->cutoffCanteenReport();
        }
        else {
            abort('Unknown Command');
        }
    }

    public function dailyReport()
    {
        //$dt = Date('2021-12-02');
        $dt = Date('Y-m-d');
        $d = Carbon::parse($dt)->subDay();
        $ctns = Canteen::all();
        foreach ($ctns as $ctn) {
            try {
                $path = 'canteen/daily/'.$ctn->id.'/DailyReport_'.$d->format('Y-m-d').'.xlsx';
                (new TransactionsExport($d,$d,$ctn->id))->store($path,'public');
                if ($ctn->email) {
                    $email = $ctn->email;
                } else {
                    $email = 'edmund_mati@sercomm.com';
                }
                Mail::to($email)
                    ->later(now()->addMinutes(1), new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));
            } catch (\Throwable $th) {
                Log::info('Daily Transaction Report: '.$th->getMessage().' | '.$d->format('Y-m-d').' | '.$ctn->name);
            }
        }
    }

    public function cutoffReport()
    {
        $mail_to = EmailGroup::where('name','=','TransactionsCutOffReport')->first()->emails()->to()->pluck('email')->toArray();
        $mail_cc = EmailGroup::where('name','=','TransactionsCutOffReport')->first()->emails()->cc()->pluck('email')->toArray();

        $dte = $this->getDateRange();
        $path = 'cutoff/TransactionReport_'.$dte['from']->format('Y-m-d').'_'.$dte['to']->format('Y-m-d').'.xlsx';
        (new TransactionsCutOffExport($dte['from'],$dte['to']))->store($path,'public');
        Mail::to($mail_to)
            ->cc($mail_cc)
            ->later(now()->addMinutes(1), new TransactionsCutoffReport($path,$dte['from'],$dte['to']));
    }
    public function cutoffCanteenReport()
    {
        $dte = $this->getDateRange();
        $ctns = Canteen::all();
        foreach ($ctns as $ctn) {
            try {
                $path = 'canteen/cutoff/'.$ctn->id.'/TransactionReport_'.$dte['from']->format('Y-m-d').'_'.$dte['to']->format('Y-m-d').'.xlsx';
                (new TransactionsCutOffExport($dte['from'],$dte['to'],$ctn->id))->store($path,'public');
                if ($ctn->email) {
                    $email = $ctn->email;
                } else {
                    $email = 'edmund_mati@sercomm.com';
                }
                Mail::to($email)
                    ->bcc('edmund_mati@sercomm.com')
                    ->later(now()->addMinutes(1), new TransactionsCutoffReport($path,$dte['from'],$dte['to'],$ctn->id));
            } catch (\Throwable $th) {
                Log::info('Cutoff Transaction Report: '.$th->getMessage().' | '.$dte['from']->format('Y-m-d').'-'.$dte['to']->format('Y-m-d').' | '.$ctn->name);
            }        }
    }
    public function getDateRange()
    {
        //$d = Date('2021-12-16');
        $d = Date('Y-m-d');
        $dt = Carbon::parse($d);
        $from = Carbon::parse($d);
        $to =Carbon::parse($d);
        if( $dt->day > 15 && $dt->day <= 31){
            $from->startOfMonth();
            $to->day(15);
        }
        elseif ($dt->day >= 1 && $dt->day < 16) {
            $from->subMonth()->day(16);
            $to->subMonth()->endOfMonth();
        }
        else {
            throw new \ErrorException('Freq2: Unknown Date.');
            //abort('Freq2: Unknown Date.');
        }
        return [
            'from'  => $from,
            'to'    => $to
        ];
    }
}
