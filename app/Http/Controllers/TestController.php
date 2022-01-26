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
        /*$mail = \App\Email::with(['email_group' => function ($query) {
            $query->where('name', '=', 'TransactionsCutOffReport');
        }]);*/
        return \App\EmailGroup::where('name','=','TransactionsCutOffReport')->first()->emails()->cc()->pluck('email')->toArray();
        $mail = \App\EmailGroup::where('name','=','TransactionsCutOffReport')->first();
        return $mail->emails()->cc()->pluck('email')->toArray();
        $mail = \App\Email::all();
        $mail_to = \App\Email::EmailGroup('TransactionsCutOffReport')->to()->pluck('email')->toArray();
        //$mail_to = $mail_to->emailGroup()->name;
        $mail_cc = \App\Email::EmailGroup('TransactionsCutOffReport')->cc()->pluck('email')->toArray();
        //$mail_cc = $mail_cc->emailGroup()->name;
        //return $mail->to()->pluck('email')->toArray()->push($mail->cc()->pluck('email')->toArray());
        return array_merge($mail_to,$mail_cc);
        return $mail_to->merge($mail_cc);
    }
}
