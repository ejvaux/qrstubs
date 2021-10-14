<?php

namespace App\Http\Controllers;

use App\Stubs;
use Illuminate\Http\Request;
use Picqer;
use App\samplestub;

class StubsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Stubs  $stubs
     * @return \Illuminate\Http\Response
     */
    public function show(Stubs $stubs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Stubs  $stubs
     * @return \Illuminate\Http\Response
     */
    public function edit(Stubs $stubs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Stubs  $stubs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stubs $stubs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Stubs  $stubs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stubs $stubs)
    {
        //
    }
    public function makeBarcode(){
        $number='122345';
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode=$generator->getBarcode('081231723897', $generator::TYPE_CODE_128);
        return view('pages.barcode',compact('number','barcode'));
    }
    public function createBarcode(){
        return view('pages.createbarcode');
    }
    public function store(Request $request)
    {
        $number=$request->number;
        $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
        $barcode=$generator->getBarcode($number, $generator::TYPE_CODE_128);

        $data = new samplestubs;
        $data->name = $request->name;
        $data->number = $request->number;
        $data->barcode = $request->barcode;
        $data->save();

        return view('barcodes');
    }

    // public function view(){
    //     $barcode = samplestubs::all();  
    // }
}
