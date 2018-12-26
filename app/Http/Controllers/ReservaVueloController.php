<?php

namespace App\Http\Controllers;

use Validator;
use App\ReservaVuelo;
use Illuminate\Http\Request;

class ReservaVueloController extends Controller
{

    public function rules(){
        return[
        'vuelo_id' =>  'required|numeric',
        'asiento_id' => 'required|numeric',
        'pasajero_id' => 'required|numeric',
        'ida_vuelta' => 'required|boolean',
        'fecha_reserva' => 'required|date',
        'hora_reserva' => 'required|string',
        'precio_reserva_vuelo' => 'required|numeric',
        'cantidad_paradas' => 'required|numeric',
        'cantidad_pasajeros' => 'required|numeric',
        'tipo_cabina' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'vuelo_id' =>  'nullable|numeric',
        'asiento_id' => 'nullable|numeric',
        'pasajero_id' => 'nullable|numeric',
        'ida_vuelta' => 'nullable|boolean',
        'fecha_reserva' => 'nullable|date',
        'hora_reserva' => 'nullable|string',
        'precio_reserva_vuelo' => 'nullable|numeric',
        'cantidad_paradas' => 'nullable|numeric',
        'cantidad_pasajeros' => 'nullable|numeric',
        'tipo_cabina' => 'nullable|numeric',
        ];
    }
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
        $validador = Validator::make($request->all(),$this->rules());
        if($validador->fails()){
            return $validador->messages();
        }
        $rv = ReservaVuelo::create($request->all());      
        $rv->save();
        return $rv;
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
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $rV = ReservaAuto::where('id', '=', $id)->first();
        $rV->update($request->all());
        return $rV;
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
