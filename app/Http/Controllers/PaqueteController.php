<?php

namespace App\Http\Controllers;

use Validator;
use App\Paquete;
use Illuminate\Http\Request;

class PaqueteController extends Controller
{

    public function rules(){
        return[
        'reserva_auto_id' =>  'required|numeric',
        'reserva_habitacion_id' => 'required|numeric',
        'precio' => 'required|numeric',
        'descuento' => 'required|numeric',
        'tipo_paquete' => 'required|numeric',
        'disponibilidad' => 'required|boolean',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquete = Paquete::all();
        return $paquete;
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
        $paquete = Paquete::create($request->all());      
        $paquete->save();
        return $paquete;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $paquete = Paquete::find($id);
        return $paquete;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Paquete $paquete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paquete $paquete)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $paquete = Paquete::find($id);
        $paquete->delete();
        return "";
    }
}
