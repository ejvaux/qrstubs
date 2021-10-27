<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Department;
use App\role;
use App\canteen;
use App\credit;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'uname', 'name', 'qrcode', 'role_id', 'password', 'department_id', 'canteen_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsto('App\Department','department_id');
    }
    public function role()
    {
        return $this->belongsto('App\Role','role_id');
    }
    public function canteen()
    {
        return $this->belongsto('App\canteen','canteen_id');
    }
    public function credit()
    {
        return $this->belongsto('App\credit','id');
    }
    
}
