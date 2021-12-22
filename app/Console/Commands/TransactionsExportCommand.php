<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Canteen;
use App\Transaction;
use App\Email;
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
        $this->ctns = Canteen::all();
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
            //$dt = Date('2021-12-02');
            $dt = Date('Y-m-d');
            $d = Carbon::parse($dt)->subDay();
            $ctns = $this->ctns;
            foreach ($ctns as $ctn) {
                $t = Transaction::whereBetween('created_at', [$d->format('Y-m-d 00:00:00'),$d->format('Y-m-d 23:59:59')])->where('canteen_id',$ctn->id)->first();
                if ($t) {
                    $path = 'canteen/daily/'.$ctn->id.'/DailyReport_'.$d->format('Y-m-d').'.xlsx';
                    (new TransactionsExport($d,$d,$ctn->id))->store($path,'public');
                    if ($ctn->email) {
                        Mail::to($ctn->email)
                            /*->send(new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));*/
                            ->later(now()->addMinutes(5), new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));
                    } else {
                        Mail::to('edmund_mati@sercomm.com')
                            /*->send(new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));*/
                            ->later(now()->addMinutes(5), new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));
                    }
                };
            }
        }
        elseif ($freq == 2) {
            $mail = Email::with(['email_group' => function ($query) {
                $query->where('name', '=', 'TransactionsCutOffReport');
            }]);
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
                abort('Freq2: Unknown Date.');
            }
            $path = 'cutoff/TransactionReport_'.$from->format('Y-m-d').'_'.$to->format('Y-m-d').'.xlsx';
            (new TransactionsCutOffExport($from,$to))->store($path,'public');
            Mail::to($mail->to()->pluck('email'))
                ->cc($mail->cc()->pluck('email'))
                /*to('edmund_mati@sercomm.com')
                ->cc(['ejvaux_05126@yahoo.com','ejvaux12@gmail.com'])*/
                /*->send(new TransactionsCutoffReport($path,$from,$to));*/
                ->later(now()->addMinutes(5), new TransactionsCutoffReport($path,$from,$to));
        }
        else {
            abort('Unknown Command');
        }
    }
}
