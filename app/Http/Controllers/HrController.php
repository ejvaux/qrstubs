<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\credit;
use App\Department;
use Auth;
use Carbon\Carbon;

class HrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = Department::all();
        $users = User::where('role_id', 'like', '3')->orderBy('status');
        $users = $users->orderBy('name')->paginate(10);
        return view('includes.table.hrTbl',compact('users', 'departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => ['nullable', 'unique:users', 'email', 'max:50'],
            'uname' => ['required', 'unique:users', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:20'],
            'qrcode' => ['nullable', 'string', 'max:20'],
            'role_id' => ['required', 'integer', 'max:4'],
            'department_id' => ['nullable', 'integer', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $qrcode = 'SPO'.$request->uname;
        $hashed = Hash::make($qrcode);
        $password = $request->password;
        $hashed2 = Hash::make($password);

        $register = new User;
        
        $register->email = $request->email;
        $register->uname = $request->uname;
        $register->name = $request->name;
        $register->qrcode = $hashed;
        $register->role_id = $request->role_id;
        $register->department_id = $request->department_id;
        $register->password = $hashed2;
        
        
        $register->save();

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = User::findOrFail($request->employee_id);
        $user->name = $request->name2;
        $user->department_id = $request->department;
        $user->status = $request->status;
        $user->save();

        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    



    
}
