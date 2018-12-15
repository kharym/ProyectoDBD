<?php

namespace App\Http\Controllers;

use App\Asiento;
use Illuminate\Http\Request;

class AsientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asiento = Asiento::all();
        return $asiento;
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
        $asiento = Asiento::create($request->all());
        $asiento->save();
        return "";  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function show(Asiento $id)
    {
        $asiento = Asiento::find($id);
        return $asiento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Asiento $asiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Asiento $asiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Asiento $id)
    {
        $asiento = Asiento::find($id);
        $asiento->delete();
        return "";
    }
}
