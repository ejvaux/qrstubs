<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function index()
    {
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
    }
}
