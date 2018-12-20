<?php

namespace App\Http\Controllers;

use App\Compra_ReservaVuelo;
use Illuminate\Http\Request;

class CompraReservaVueloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra_reservaVuelo = Compra_ReservaVuelo::all();
        return $compra_reservaVuelo;
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
        $compraRV = Compra_ReservaVuelo::create($request->all());
        if ($compraRV) 
        {
            return $compraRV; 
        } 
        else 
        {
            $response = ['error' => 'Ha ocurrido un error en la Base de Datos al actualizar!'];
            return $response;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra_ReservaVuelo  $compra_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $compra_reservaVuelo = Compra_ReservaVuelo::find($id);
        return $compra_reservaVuelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra_ReservaVuelo  $compra_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra_ReservaVuelo $compra_ReservaVuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra_ReservaVuelo  $compra_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Compra_ReservaVuelo $compra_ReservaVuelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra_ReservaVuelo  $compra_ReservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $compra_reservaVuelo = Compra_ReservaVuelo::find($id);
        $compra_reservaVuelo->delete();
        return "";
    }
}
