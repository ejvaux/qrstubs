<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Canteen;
use App\Transaction;
use App\Exports\TransactionsExport;
use App\Mail\TransactionsReport;

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
            //$dt = Date('Y-m-d');
            $dt = Date('2021-11-11');
            $d = Carbon::parse($dt)->subDay();
            $ctns = Canteen::all();
            foreach ($ctns as $ctn) {
                $t = Transaction::whereBetween('created_at', [$d,$dt])->where('canteen_id',$ctn->id)->first();
                if ($t) {
                    $path = 'canteen/'.$ctn->id.'/DailyReport_'.$d->format('Y-m-d').'.xlsx';
                    (new TransactionsExport($d,$dt,$ctn->id))->store($path,'public');
                    if ($ctn->email) {
                        Mail::to($ctn->email)->send(new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));
                    } else {
                        Mail::to('edmund_mati@sercomm.com')->send(new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));
                    }

                    /*Mail::to($ctn->email)->send(new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));*/
                };
            }
        }
        elseif ($freq == 2) {
            # code...
        }
        else {
            abort('Unknown Command');
        }
    }
}
