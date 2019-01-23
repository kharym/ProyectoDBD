<?php

namespace App\Http\Controllers;

use App\Paquete_ReservaVuelo;
use Illuminate\Http\Request;

class PaqueteReservaVueloController extends Controller
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
        $paquete_ReservaVuelo = Paquete_ReservaVuelo::all();
        if ($paquete_ReservaVuelo) 
        {
            return $paquete_ReservaVuelo; 
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
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $mp = Paquete_ReservaVuelo::where('id', '=', $id)->first();
        $mp->update($request->all());
        return $mp;
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
