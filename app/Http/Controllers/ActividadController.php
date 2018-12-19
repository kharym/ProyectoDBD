<?php

namespace App\Http\Controllers;

use App\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{
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
        $actividad = Actividad::create($request->all());
        if ($actividad) 
        {
            $response = ['success' => 'Actualizado con éxito!'];
        } 
        else 
        {
            $response = ['error' => 'Ha ocurrido un error en la Base de Datos al actualizar!'];
        }
        return $response; 
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
        $aux = $this->validate($request, [
            'destino' => 'required',
            'nombre_actividad' => 'required',
            'precio' => 'required',
            'cantidad_adulto' => 'required',
            'cantidad_ninos' => 'required',
            'fecha_ida' => 'required',
            'fecha_vuelta' => 'required',
        ]);
        dd($aux);
        dd($errors->all());
        $actividad->destino = $request->get('destino');
        $actividad->nombre_actividad = $request->get('nombre_actividad');
        $actividad->precio = $request->get('precio');
        $actividad->cantidad_adultos = $request->get('cantidad_adulto');
        $actividad->cantidad_ninos = $request->get('cantidad_ninos');
        $actividad->fecha_ida = $request->get('fecha_ida');
        $actividad->fecha_vuelta = $request->get('fecha_vuelta');
          
        $dataUpdate = $actividad->save();
        if ($dataUpdate) 
        {
            $response = ['success' => 'Actualizado con éxito!'];
        } 
        else 
        {
            $response = ['error' => 'Ha ocurrido un error en la Base de Datos al actualizar!'];
        }
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
