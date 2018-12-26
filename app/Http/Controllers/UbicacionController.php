<?php

namespace App\Http\Controllers;

use Validator;
use App\Ubicacion;
use Illuminate\Http\Request;

class UbicacionController extends Controller
{

    public function rules(){
        return[
        'ciudad_id' =>  'required|numeric',
        'latitud' => 'required|numeric',
        'longitud' => 'required|numeric',
        'codigo_postal' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'ciudad_id' =>  'nullable|numeric',
        'latitud' => 'nullable|numeric',
        'longitud' => 'nullable|numeric',
        'codigo_postal' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ubicacion = Ubicacion::all();
        return $ubicacion;
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
        $ubicacion = Ubicacion::create($request->all());      
        $ubicacion->save();
        return $ubicacion;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $ubicacion = Ubicacion::find($id);
        return $ubicacion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Ubicacion $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $ub = Ubicacion::where('id', '=', $id)->first();
        $ub->update($request->all());
        return $ub;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $ubicacion = Ubicacion::find($id);
        $ubicacion->delete();
        return "";
    }
}
