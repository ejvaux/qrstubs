<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class canteen extends Model
{
    public function transactions()
    {
        return $this->hasmany('App\Transaction');
    }
}
