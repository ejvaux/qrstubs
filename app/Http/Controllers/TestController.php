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
        $input = "How much is that doggie in the window? I do hope that doggie's for sale.";
        $max = 10;
        $out = '';
        $c = 0;
        $s = preg_split("[[\.\?\!\r\n]]",$input,-1,PREG_SPLIT_NO_EMPTY | PREG_SPLIT_OFFSET_CAPTURE);
        foreach ($s as $i => $w) {
            $c += count(explode(' ',trim($w[0])));
            if ($c <= $max) {
                if(isset($s[$i+1])){
                    $end = $s[$i+1][1];
                }
                else{
                    $end = strlen($input);
                }
                $out .= substr($input,$w[1],$end);
            }
        }
        return $out;
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
