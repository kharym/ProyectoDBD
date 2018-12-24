<?php

namespace App\Http\Controllers;

use Validator;
use App\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{

    public function rules(){
        return[
        'destino' =>  'required|string',
        'nombre_actividad' => 'required|string',
        'precio' => 'required|numeric',
        'cantidad_adulto' => 'required|numeric',
        'cantidad_ninos' => 'required|numeric',
        'fecha_ida' => 'required|date',
        'fecha_vuelta' => 'required|date',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividad = Actividad::all();
        return $actividad;
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
        $actividad = Actividad::create($request->all());      
        $actividad->save();
        return $actividad;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $actividad = Actividad::find($id);
        return $actividad;    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Actividad $actividad)
    {
        $validador = Validator::make($request->all(),$this->rules());
        if($validador->fails()){
            return $validador->messages();
        }
        $actividad->destino = $request->get('destino');
        $actividad->nombre_actividad = $request->get('nombre_actividad');
        $actividad->precio = $request->get('precio');
        $actividad->cantidad_adultos = $request->get('cantidad_adulto');
        $actividad->cantidad_ninos = $request->get('cantidad_ninos');
        $actividad->fecha_ida = $request->get('fecha_ida');
        $actividad->fecha_vuelta = $request->get('fecha_vuelta');      
        $actividad->save();
        return $actividad;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        $actividad->delete();
        return "";
    }
}
