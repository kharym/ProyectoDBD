<?php

namespace App\Http\Controllers;

use App\reservaActividad;
use Illuminate\Http\Request;

class ReservaActividadController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reservaActividad  $reservaActividad
     * @return \Illuminate\Http\Response
     */
    public function show(reservaActividad $reservaActividad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reservaActividad  $reservaActividad
     * @return \Illuminate\Http\Response
     */
    public function edit(reservaActividad $reservaActividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reservaActividad  $reservaActividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reservaActividad $reservaActividad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reservaActividad  $reservaActividad
     * @return \Illuminate\Http\Response
     */
    public function destroy(reservaActividad $reservaActividad)
    {
        //
    }

    public function carritoCompraActividad($id,$personas){
        $fecha = date('Y-m-d');
        $actividad = \App\Actividad::find($id);
        $reserva = new \App\reservaActividad();
        $reserva->cantidad_personas = $personas;
        $reserva->precio =  $actividad->precio*$personas;
        $reserva->actividad_id = $actividad->id;
        $reserva->fecha_reserva = $fecha;
        request()->session()->push('reservaActividad',$reserva);     
        return view('carrito.carrito');
    }
}
