<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;
use Carbon\Carbon;
use App\Canteen;
use App\Transaction;
use App\Email;
use App\Exports\SummaryExport;
use App\Mail\SummaryCutoffReport;
use App\Mail\SummaryCutoffReport2;
use DB;

class SummaryReportCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'summary-report:file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending of summary transaction report.';

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
        $mail = Email::with(['email_group' => function ($query) {
            $query->where('name', '=', 'SummaryReport');
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
            $to->subMonth()->endOfMonth()->startOfDay();
        }
        else {
            abort('Unknown Date.');
        }
        $path = 'summary/SummaryReport_'.$from->format('Y-m-d').'_'.$to->format('Y-m-d').'.xlsx';
        (new SummaryExport($from,$to))->store($path,'public');
        Mail::
            //   to($mail->to()->pluck('email'))
            // ->cc($mail->cc()->pluck('email'))
            to(['Divine_Goce@SERCOMM.COM', 'Katrina_Naron@SERCOMM.COM'] )
            ->cc(['lawrence_bondad@sercomm.com', 'Edmund_Mati@SERCOMM.COM', 'Oj_Orjalo@SERCOMM.COM', 'Rax_Chiang@SERCOMM.COM', 'Bruce_Dai@sercomm.com.cn', 'Jesse_Xia@sercomm.com.cn'])
            ->send(new SummaryCutoffReport2($path,$from,$to));
        
        // $users = [
        //     0 => ['email' => 'lawrence_bondad@sercomm.com','name' => "Lawrence Bondad"],  
        //     1 => ['email' => 'lawrence_bondad@sercomm.com','name' => "Lawrence Bondad"],
        // ];
        // foreach ($users as $user){
        //     $this->info("Saved User ". $user['name']);
        // }
        //     // if ($freq == 1) {
        //         $this->info('Done!');
        //     // }
    }
}
