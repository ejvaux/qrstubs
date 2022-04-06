<?php

use Illuminate\Database\Seeder;

class CheckFailedJobsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $eg = new App\EmailGroup;
        $eg->name = 'CheckFailedJobs';
        $eg->save();

        $e = new App\Email;
        $e->email_group_id = $eg->id;
        $e->type = 'to';
        $e->email = 'Edmund_Mati@SERCOMM.COM';
        $e->active = 1;
        $e->save();
    }
}
