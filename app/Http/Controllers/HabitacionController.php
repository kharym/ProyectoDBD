<?php

namespace App\Http\Controllers;

use Validator;
use App\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{

    public function rules(){
        return[
        'reserva_habitacion_id' =>  'required|numeric',
        'alojamiento_id' =>  'required|numeric',
        'numero_habitacion' => 'required|numeric',
        'tipo_habitacion' => 'required|numeric',
        'numero_camas' =>  'required|numeric',
        'numero_banos' => 'required|numeric',
        'disponibilidad' => 'required|boolean',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //devuelve todo
    public function index()
    {
        $habitacion = Habitacion::all();
        return $habitacion;
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
        $hab = Habitacion::create($request->all());      
        $hab->save();
        return $hab;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habitacion = Habitacion::find($id);
        return $habitacion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitacion $habitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Habitacion $habitacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::find($id);
        $habitacion->delete();
        return "";
    }
}
