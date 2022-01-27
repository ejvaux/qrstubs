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
        $dt = Date('2021-12-02');
        //$dt = Date('Y-m-d');
        $d = Carbon::parse($dt)->subDay();
        //$a = \App\Transaction::whereBetween('created_at', [$d->startOfDay()->format('Y-m-d H:i:s'),$d->endOfDay()->format('Y-m-d H:i:s')])->get();
        $a = \App\Transaction::whereBetween('created_at', [$d->format('Y-m-d 00:00:00'),$d->format('Y-m-d 23:59:59')])->where('canteen_id',1)->get();
        return $a;
        //$d = Date('2021-12-1');
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
        //return  $from->format('Y-m-d').'--'.$to->addDay()->format('Y-m-d');
        /*$ctns = \App\Canteen::withCount(['transactions as transactions_sum' => function($query) use ($from,$to) {
            $query->select(\DB::raw('sum(price)'))
                ->whereBetween('created_at', [$from, $to->addDay()]);
        }])->get();*/
        $path = 'cutoff/TransactionReport_'.$from->format('Y-m-d').'_'.$to->format('Y-m-d').'.xlsx';
        //return $ctns;
        // return new \App\Mail\TransactionsCutoffReport($path,$from,$to);
        return new App\Export\SummaryCreditExport;
    }
}
