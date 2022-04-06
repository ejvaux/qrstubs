<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class TestController extends Controller
{
    use \App\Traits\CustomMethods;

    public function index()
    {
        $ctns = \App\canteen::withCount(['transactions as transactions_sum' => function($query) {
            $query->select(\DB::raw('sum(price)'))
                ->whereBetween('created_at', [Date('2021-12-01'), Date('2021-12-15')]);
        }])->with(['transactions' => function($q){
            $q->select('canteen_id','control_no')
                ->whereBetween('created_at', [Date('2021-12-01'), Date('2021-12-15')])
                ->groupBy('canteen_id','control_no');
        }]);
        return $ctns->get();
    }

    public function getFailedJobsPayload($id)
    {
        $payload = DB::table('failed_jobs')->select('payload')->where('id',$id)->first()->payload;
        $jsonpayload = json_decode($payload);
        $data = unserialize($jsonpayload->data->command);
        $jsonpayload->data->command = $data;
        return json_encode($jsonpayload);
    }
}
