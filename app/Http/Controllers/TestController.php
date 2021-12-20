<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class TestController extends Controller
{
    public function index()
    {
        $d = Date('2021-12-1');
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
        //return  $from->format('Y-m-d').'--'.$to->addDay()->format('Y-m-d');
        $ctns = \App\Canteen::withCount(['transactions as transactions_sum' => function($query) use ($from,$to) {
            $query->select(\DB::raw('sum(price)'))
                ->whereBetween('created_at', [$from, $to->addDay()]);
        }])->get();
        $path = 'cutoff/TransactionReport_'.$from->format('Y-m-d').'_'.$to->format('Y-m-d').'.xlsx';
        return $ctns;
        return new \App\Mail\TransactionsCutoffReport($ctns,$path,$from->format('F d, Y'),$to->format('F d, Y'));
    }
}
