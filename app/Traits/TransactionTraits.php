<?php

namespace App\Traits;

use App\User;

trait TransactionTraits
{
    public function isGuest($id)
    {
        $user = User::where('id','=',$id)->where('department_id','=','5')->first();
        if ($user) {
            return true;
        }
    }
}