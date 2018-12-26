<?php

namespace App\Http\Controllers;

use Validator;
use App\Aeropuerto;
use Illuminate\Http\Request;

class AeropuertoController extends Controller
{

    public function rules(){
        return[
        'ciudad_id' => 'required|string',
        'nombre_aeropuerto' => 'required|string',
        'calle_aeropuerto' => 'required|string',
        'numero_aeropuerto' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'ciudad_id' => 'nullable|string',
        'nombre_aeropuerto' => 'nullable|string',
        'calle_aeropuerto' => 'nullable|string',
        'numero_aeropuerto' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aeropuerto = Aeropuerto::all();
        return $aeropuerto;
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
        $aeropuerto = Aeropuerto::create($request->all());      
        $aeropuerto->save();
        return $aeropuerto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $aeropuerto = Aeropuerto::find($id);
        return $aeropuerto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function edit(Aeropuerto $aeropuerto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $aeropuerto = Aeropuerto::where('id', '=', $id)->first();
        $aeropuerto->update($request->all());
        return $aeropuerto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Aeropuerto  $aeropuerto
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $aeropuerto = Aeropuerto::find($id);
        $aeropuerto->delete();
        return "";
    }
}
