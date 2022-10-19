<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Email;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function report()
    {
        $emails = Email::withoutGlobalScopes()->where('email_group_id',1)->get();

        return view('pages.admin.report',compact('emails'));
    }

    public function reportEdit($id)
    {
        $email = Email::withoutGlobalScopes()->where('id',$id)->first();
        return view('pages.admin.reportEdit',compact('email'));
    }
}
