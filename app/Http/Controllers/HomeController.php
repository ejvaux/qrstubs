<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\credit;
use App\Role;
use App\Department;
use App\canteen;
use Auth;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function pages()
    {
        if((Auth::user()->role_id==1)){
            return redirect('hr');
        }
        elseif((Auth::user()->role_id==2))
        {
            return redirect('canteen');
        }
        elseif((Auth::user()->role_id==3))
        {
            return redirect('user');
        }
    }
    public function hr(Request $req)
    {
        return view('pages.hr.hr-home');
    }
    public function canteen(Request $req)
    {
        return view('pages.canteen.ctn-home');
    }
    public function user(Request $req)
    {
        return view('pages.user.user-qr');
    }
}
