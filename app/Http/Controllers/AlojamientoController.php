<?php

namespace App\Http\Controllers;

use Validator;
use App\Alojamiento;
use Illuminate\Http\Request;

class AlojamientoController extends Controller
{

    public function rules(){
        return[
        'ciudad_id' =>  'required|string',
        'nombre_alojamiento' => 'required|string',
        'numero_estrellas' => 'required|numeric',
        'calle_alojamiento' => 'required|string',
        'numero_alojamiento' => 'required|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $alojamiento = Alojamiento::all();
        return $alojamiento;
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
        $alojamiento = Alojamiento::create($request->all());      
        $alojamiento->save();
        return $alojamiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $alojamiento = Alojamiento::find($id);
        return $alojamiento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Alojamiento $alojamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alojamiento $alojamiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $alojamiento = Alojamiento::find($id);
        $alojamiento->delete();
        return "";
    }
}
