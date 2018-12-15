<?php

namespace App\Http\Controllers;

use App\Pasajero;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasajero = Pasajero::all();
        return $pasajero;

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
        $pasajero = Pasajero::create($request->all());
        $pasajero->save();
        return "";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $pasajero = Pasajero::find($id);
        return $pasajero;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasajero $pasajero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pasajero $pasajero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $pasajero = Pasajero::find($id);
        $pasajero->delete();
        return "";
    }
}
