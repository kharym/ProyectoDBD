<?php

namespace App\Http\Controllers;

use Validator;
use App\ReservaHabitacion;
use Illuminate\Http\Request;

class ReservaHabitacionController extends Controller
{


    public function rules(){
        return[
        'precio_res_hab' =>  'required|numeric',
        'fecha_llegada' => 'required|date',
        'fecha_ida' => 'required|date',
        'numero_ninos' => 'required|numeric',
        'numero_adulto' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'precio_res_hab' =>  'nullable|numeric',
        'fecha_llegada' => 'nullable|date',
        'fecha_ida' => 'nullable|date',
        'numero_ninos' => 'nullable|numeric',
        'numero_adulto' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaHabitacion = ReservaHabitacion::all();
        return $reservaHabitacion;
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
        $rh = ReservaHabitacion::create($request->all());      
        $rh->save();
        return $rh;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $reservaHabitacion = ReservaHabitacion::find($id);
        return $reservaHabitacion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservaHabitacion $reservaHabitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $rH = ReservaHabitacion::where('id', '=', $id)->first();
        $rH->update($request->all());
        return $rH;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $reservaHabitacion = ReservaHabitacion::find($id);
        $reservaHabitacion->delete();
        return "";
    }
}
