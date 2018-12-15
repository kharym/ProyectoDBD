<?php

namespace App\Http\Controllers;

use App\Paquete_ReservaVuelo;
use Illuminate\Http\Request;

class Paquete_ReservaVueloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquete_ReservaVuelo = Paquete_ReservaVuelo::all();
        return $paquete_ReservaVuelo;
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
        $paquete_ReservaVuelo = Paquete_ReservaVuelo::create($request->all());
        $paquete_ReservaVuelo->save();
        return ""; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paquete_ReservaVuelo  $paquete_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $paquete_ReservaVuelo = Paquete_ReservaVuelo::find($id);
        return $paquete_ReservaVuelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paquete_ReservaVuelo  $paquete_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Paquete_ReservaVuelo $paquete_ReservaVuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paquete_ReservaVuelo  $paquete_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paquete_ReservaVuelo $paquete_ReservaVuelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paquete_ReservaVuelo  $paquete_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $paquete_ReservaVuelo = Paquete_ReservaVuelo::find($id);
        $paquete_ReservaVuelo->delete();
        return "";
    }
}
