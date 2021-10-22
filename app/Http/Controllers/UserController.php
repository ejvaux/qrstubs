<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\credit;
use App\Role;
use App\Department;
use App\canteen;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        $credits = credit::all();
        $departments = Department::all();
        $canteens = canteen::all();
        $name = $request->input('searchtxt');
        if($name == ""){
            $employees = User::paginate(10);
        }
        else{
            $employees = User::where('name', 'like', '%'.$name.'%')->paginate(10);
        }

        return view('',compact('employees','roles', 'credits', 'departments', 'canteens'));
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
            'uname' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:20'],
            'qrcode' => ['required', 'string', 'max:20'],
            'credit_id' => ['nullable', 'string', 'max:20'],
            'role_id' => ['required', 'integer', 'max:20'],
            'department_id' => ['nullable', 'integer', 'max:20'],
            'canteen_id' => ['nullable', 'integer', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            
        ]);

        $credit = 'SPI'.$request->uname;
        $qrcode = 'SPO'.$request->uname;
        $hashed = Hash::make($qrcode);
        $password = $request->password;
        $hashed2 = Hash::make($password);

        $register = new User;
        
        $register->uname = $request->uname;
        $register->name = $request->name;
        $register->qrcode = $hashed;
        $register->credit_id = $credit;
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
    public function update(Request $request, $id)
    {
        $employee = User::findOrFail($request->employee_id);
        $employee->name = $request->name;
        $employee->uname = $request->uname;
        $employee->role_id = $request->role_id;
        $employee->canteen_id = $request->canteen_id;
        $employee->department_id = $request->department_id;
        $employee->save();
       
        return 'success';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
