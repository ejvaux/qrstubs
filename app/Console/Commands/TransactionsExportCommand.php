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
    protected $signature = 'transactions:export';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export transactions into excel';

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
        /*$dt = Date('Y-m-d');*/
        $dt = Date('2021/11/11');
        $d = Carbon::parse($dt)->subDay();
        $ctns = Canteen::all();
        foreach ($ctns as $ctn) {
            $t = Transaction::whereBetween('created_at', [$d,$dt])->where('canteen_id',$ctn->id)->first();
            if ($t) {
                $path = 'canteen/'.$ctn->id.'/DailyReport_'.$d->format('Y-m-d').'.xlsx';
                (new TransactionsExport($d,$dt,$ctn->id))->store($path,'public');
                Mail::to($ctn->email)->send(new TransactionsReport($ctn->name,$path,$d->format('F d, Y')));
            };
        }
    }
}
