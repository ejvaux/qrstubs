<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Department;
use App\role;
use App\canteen;
use App\credit;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';
    protected function redirectTo()
    {
        $credits = credit::all();
        $roles = Role::all();
        $departments= Department::all();
        $canteens= canteen::all();

        return view('/home', compact('credits','roles','departments','canteens' ));
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
        return Validator::make($data, [
            'uname' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:20'],
            'role' => ['required', 'string', 'max:20'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'uname' => $data['uname'],
            'name' => $data['name'],
            'qrcode' => $data['qrcode'],
            'credit_id' => $data['credit_id'],
            'role_id' => $data['role_id'],
            'department_id' => $data['department_id'],
            'credit_id' => $data['credit_id'],
            'password' => Hash::make($data['password']),
        ]);
        
    }
}
