<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

class TestController extends Controller
{
    public function index()
    {
        $user = \App\User::whereHas('transactions2', function ($query) {
            $query->pending();
        })
        ->with(['transactions2'=> function ($query) {
            $query->pending();
        }])
        ->get();
        $ids = $user->pluck('transactions2')->flatten(1)->pluck('id');
        return $user;
    }
}
