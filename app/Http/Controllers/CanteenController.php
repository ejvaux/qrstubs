<?php

namespace App\Http\Controllers;

use App\canteen;
use Auth;
use App\User;
use App\transaction;
use Illuminate\Http\Request;

class CanteenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $canteen = Auth::user()->canteen_id;

        //Don't forget pagination when displaying table
        $transactions = transaction::where('canteen_id', 'like', $canteen)
                    ->orderBy('id', 'DESC')->paginate(10);

        return view('includes.table.ctnTbl', compact('transactions', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\canteen  $canteen
     * @return \Illuminate\Http\Response
     */
    public function show(canteen $canteen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\canteen  $canteen
     * @return \Illuminate\Http\Response
     */
    public function edit(canteen $canteen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\canteen  $canteen
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, canteen $canteen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\canteen  $canteen
     * @return \Illuminate\Http\Response
     */
    public function destroy(canteen $canteen)
    {
        //
    }
}
