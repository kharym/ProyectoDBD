<?php

namespace App\Http\Controllers;

use Validator;
use App\Pasajero;
use Illuminate\Http\Request;

class PasajeroController extends Controller
{

    public function rules(){
        return[
        'name' =>  'required|string',
        'apellido' => 'required|string',
        'dni_pasaporte' => 'required|numeric',
        'pais' => 'required|string',
        'menor_edad' => 'required|boolean',
        'telefono' => 'required|numeric',
        'asistencia_especial' => 'required|boolean',
        'movilidad_reducida' => 'required|boolean',
        ];
    }

    public function rules2(){
        return[
        'name' =>  'nullable|string',
        'apellido' => 'nullable|string',
        'dni_pasaporte' => 'nullable|numeric',
        'pais' => 'nullable|string',
        'menor_edad' => 'nullable|boolean',
        'telefono' => 'nullable|numeric',
        'asistencia_especial' => 'nullable|boolean',
        'movilidad_reducida' => 'nullable|boolean',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasajero = Pasajero::all();
        return $pasajero;

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
        $pasajero = Pasajero::create($request->all());      
        $pasajero->save();
        return $pasajero;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $pasajero = Pasajero::find($id);
        return $pasajero;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function edit(Pasajero $pasajero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $pasajero = Pasajero::where('id', '=', $id)->first();
        $pasajero->update($request->all());
        return $pasajero;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pasajero  $pasajero
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $pasajero = Pasajero::find($id);
        $pasajero->delete();
        return "";
    }
}
