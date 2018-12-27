<?php

namespace App\Http\Controllers;

use Validator;
use App\Vuelo;
use Illuminate\Http\Request;

class VueloController extends Controller
{
 
    public function rules(){
        return[
        'ciudad_va_id' =>  'required|numeric',
        'ciudad_viene_id' => 'required|numeric',
        'origen' => 'required|string',
        'destino' => 'required|string',
        'precio_vuelo' => 'required|numeric',
        'cantidad_asientos' => 'required|numeric',
        'fecha_ida' => 'required|date',
        'hora_ida' => 'required|string',
        'fecha_llegada' => 'required|date',
        'hora_llegada' => 'required|string',
        'duracion_viaje' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'ciudad_va_id' =>  'nullable|numeric',
        'ciudad_viene_id' => 'nullable|numeric',
        'origen' => 'nullable|string',
        'destino' => 'nullable|string',
        'precio_vuelo' => 'nullable|numeric',
        'cantidad_asientos' => 'nullable|numeric',
        'fecha_ida' => 'nullable|date',
        'hora_ida' => 'nullable|string',
        'fecha_llegada' => 'nullable|date',
        'hora_llegada' => 'nullable|string',
        'duracion_viaje' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vuelo = Vuelo::all();
        return $vuelo;
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
        $vuelo = Vuelo::create($request->all());      
        $vuelo->save();
        return $vuelo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $vuelo = Vuelo::find($id);
        return $vuelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vuelo $vuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $vuelo = Vuelo::where('id', '=', $id)->first();
        $vuelo->update($request->all());
        return $vuelo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $vuelo = Vuelo::find($id);
        $vuelo->delete();
        return "";
    }
}
