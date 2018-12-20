<?php

namespace App\Http\Controllers;

use App\ReservaAuto;
use Illuminate\Http\Request;

class ReservaAutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaAuto = ReservaAuto::all();
        return $reservaAuto;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rA = ReservaAuto::all();
        if ($rA) 
        {
            return $rA; 
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
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $reservaAuto = ReservaAuto::find($id);
        return $reservaAuto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservaAuto $reservaAuto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservaAuto $reservaAuto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $reservaAuto = ReservaAuto::find($id);
        $reservaAuto->delete();
        return "";
    }
}
