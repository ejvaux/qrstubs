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
        return self::generateControlNum();

        $pending = \App\Transaction::withoutGlobalScopes()
                ->where('user_id',38)
                ->pending()
                ->first();
        if ($pending) {
            return $pending;
        } else {
            return $pending->count();
        }


        $t1 = \App\Transaction::withoutGlobalScopes()
                    ->where('user_id',11)
                    ->where('credit_id',5)
                    ->confirmed()
                    ->sum('price');
        $t2 = \App\Transaction::withoutGlobalScopes()
                    ->where('user_id',11)
                    ->where('credit_id',5)
                    ->pending()
                    ->sum('price');
        $t3 = \App\Transaction::withoutGlobalScopes()
                    ->where('user_id',11)
                    ->where('credit_id',5)
                    ->used()
                    ->sum('price');
        return [
            'confirmed'=> $t1,
            'pending' => $t2,
            'used' => $t3,
        ];
        $user = \App\User::whereHas('transactions2', function ($query) {
            $query->pending();
        })
        ->with(['transactions2'=> function ($query) {
            $query->pending();
        }])
        ->get();
        $ids = $user->pluck('transactions2')->flatten(1)->pluck('id');
        return $user;
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
