<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class PrintController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('print.print');
    }

    public function layout()
    {
        return view('print.layoutStubs');
    }

    public function index2()
      {
            $students = Student::all();
            return view('printstudent')->with('students', $students);;
      }
      public function prnpriview()
      {
            $students = Student::all();
            return view('students')->with('students', $students);;
      }
}
