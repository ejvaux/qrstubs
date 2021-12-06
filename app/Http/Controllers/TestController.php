<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $dt = Date('2021-12-15');
        $d = \Carbon\Carbon::parse($dt);
        $year = $d->format('Y');
        $month = $d->format('m');
        $day = $d->format('d');
        $ldate = $d->format('t');
        $con = $month.'-'.$year;
        if ($day <= 15) {
            $con = '16-'.$con;
        } else {
            //$con = Date($ldate.'-'.$month.'-'.$year);
            // $con = Date($year.'-'.$month.'-'.$ldate);
            $con = \Carbon\Carbon::parse($ldate.'-'.$month.'-'.$year)->addDay()->format('d-m-Y');
            // $con = $con->format('d-m-Y');
        }

        return $con;
        /*return App\customFunctions::generateExpirationDate('SPI202110B');*/
        /*$ctrl = 'SPI202110B';
        $users =  App\User::query()->where('role_id',3)->with(['department','credits' => function($q)use($ctrl){
            $q->where('control_no', $ctrl);
        },'transactions' => function($q) use($ctrl){
            $q->where('transactions.control_no', $ctrl);
        }])->get();
        return $users;*/

        /*$users = App\User::find(['3','4']);
        $credits = App\Credit::all();
        $scanner = App\User::find(2);
        $digits = 2;
        $num = 10;
        foreach ($users as $user) {
            foreach ($credits as $credit) {
                if ($credit->user_id == $user->id) {
                    for ($i=0; $i < $num; $i++) {
                        $c = new App\Transaction;
                        $c->user_id = $user->id;
                        $c->scanner_id = $scanner->id;
                        $c->credit_id = $credit->id;
                        $c->control_no = $credit->control_no;
                        $c->canteen_id = $scanner->canteen_id;
                        $c->price = rand(pow(10, $digits-1), pow(10, $digits)-1);
                        $c->save();
                        echo '<pre>'.$c.'</pre>';
                    }
                }
            }
        }*/
    }
}
