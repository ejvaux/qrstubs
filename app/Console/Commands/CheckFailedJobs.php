<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\TaskFailed;
use Illuminate\Support\Facades\DB;

class CheckFailedJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job:fail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check failed jobs and send email.';

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
        $jobs = DB::table('failed_jobs')->get();
        if ($jobs->count()) {
            $emailTo = \App\EmailGroup::where('name','=','CheckFailedJobs')->first()->emails()->to()->pluck('email')->toArray();
            Mail::to($emailTo)
                    ->send(new TaskFailed($jobs));
        }
    }
}
