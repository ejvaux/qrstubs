<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class credit extends Model
{
    public function user()
    {
        return $this->belongsto('App\User');
    }
    public function transactions()
    {
        return $this->hasMany('App\Transaction');
    }
}