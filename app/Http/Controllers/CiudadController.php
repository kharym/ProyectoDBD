<?php

namespace App\Http\Controllers;

use Validator;
use App\Ciudad;
use Illuminate\Http\Request;

class CiudadController extends Controller
{

    public function rules(){
        return[
        'pais_id' =>  'required|numeric',
        'nombre_ciudad' => 'required|string',
        ];
    }

     public function rules2(){
        return[
        'pais_id' =>  'nullable|numeric',
        'nombre_ciudad' => 'nullable|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ciudad = Ciudad::all();
        return $ciudad;
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
        $ciudad = Ciudad::create($request->all());      
        $ciudad->save();
        return $ciudad;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $ciudad = Ciudad::find($id);
        return $ciudad;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function edit(Ciudad $ciudad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $ciudad = Ciudad::where('id', '=', $id)->first();
        $ciudad->update($request->all());
        return $ciudad;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ciudad  $ciudad
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $ciudad = Ciudad::find($id);
        $ciudad->delete();
        return "";
    }

   
}
