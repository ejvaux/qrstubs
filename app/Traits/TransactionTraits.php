<?php

namespace App\Traits;

use App\User;

trait TransactionTraits
{
    public function isGuest($id)
    {
        $user = User::where('id','=',$id)->where('uname','like','Guest%')->first();
        if ($user) {
            return true;
        }
    }
}