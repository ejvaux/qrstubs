<?php

namespace App;

use App\canteen;
use App\User;
use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    public function canteen()
    {
        return $this->belongsto('App\canteen','canteen_id');
    }
    public function user()
    {
        return $this->belongsto('App\User','user_id');
    }
}
