<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\transaction;
use Auth;

class credit extends Model
{
    
    public function user()
    {
        return $this->belongsto('App\User','user_id');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }

}
