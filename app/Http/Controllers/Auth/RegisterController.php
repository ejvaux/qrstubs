<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Department;
use App\Role;
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
    protected $redirectTo = '/';
    public function showRegistrationForm()
    {
        $departments= Department::all();
        $roles = Role::all();
        $canteens = canteen::all();
        return view('auth.register', compact('departments', 'roles','canteens'));
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
            'email' => ['nullable', 'unique:users', 'email', 'max:50'],
            'uname' => ['required', 'unique:users', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:20'],
            'qrcode' => ['nullable', 'string', 'max:20'],
            'role_id' => ['required', 'integer', 'max:20'],
            'department_id' => ['nullable', 'integer', 'max:20'],
            'canteen_id' => ['nullable', 'integer', 'max:20'],
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
        $qrcode = 'SPO'.$data['uname'];

        return User::create([
            'email' => $data['email'],
            'uname' => $data['uname'],
            'name' => $data['name'],
            'qrcode' => Hash::make($qrcode),
            'role_id' => $data['role_id'],
            'department_id' => $data['department_id'],
            'canteen_id' => $data['canteen_id'],
            'password' => Hash::make($data['password']),
        ]);
        
    }
}
