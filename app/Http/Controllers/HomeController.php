<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\role;
use App\canteen;

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
        $departments= Department::all();

        return view('home', compact('departments'));
    }
    public function userhome()
    {
        return view('pages/userpage');
    }
}
