<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        /*return App\customFunctions::generateExpirationDate('SPI202110B');*/
    /*$ctrl = 'SPI202110B';
    $users =  App\User::query()->where('role_id',3)->with(['department','credits' => function($q)use($ctrl){
        $q->where('control_no', $ctrl);
    },'transactions' => function($q) use($ctrl){
        $q->where('transactions.control_no', $ctrl);
    }])->get();
    return $users;*/

    $users = App\User::find(['3','4']);
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
    }
    }
}
