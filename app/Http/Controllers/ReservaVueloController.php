<?php

namespace App\Http\Controllers;

use App\ReservaVuelo;
use Illuminate\Http\Request;

class ReservaVueloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaVuelo = ReservaVuelo::all();
        return $reservaVuelo;
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
        $rV = ReservaVuelo::all();
        if ($rV) 
        {
            return $rV; 
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
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $reservaVuelo = ReservaVuelo::find($id);
        return $reservaVuelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservaVuelo $reservaVuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservaVuelo $reservaVuelo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $reservaVuelo = ReservaVuelo::find($id);
        $reservaVuelo->delete();
        return "";
    }
}
