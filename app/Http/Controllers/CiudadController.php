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
        return view('admin.agregar-ciudad');
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

    public function aeropuertos( $id)
    {
        $aeropuertos = Ciudad::with('aeropuerto')->find($id);
        return $aeropuertos;
    }

    public function agregarCiudad(){

        $ciudad = new Ciudad();
        $usuario = auth()->user();
        $auditoria = new \App\Auditoria();
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');

        $ciudad->pais_id = request()->pais;
        $ciudad->nombre_ciudad = request()->nombreCiudad;
        $pais = \App\Pais::find($ciudad->pais_id);
        $auditoria->user_id = $usuario->id;
        $auditoria->tipo_auditoria = 1;
        $auditoria->fecha_auditoria = $fecha;
        $auditoria->hora_auditoria = $hora;
        $auditoria->descripcion = $auditoria->descripcion."Se agregó la ciudad ".$ciudad->nombre_ciudad." del país ".$pais->nombre_pais ." " . $fecha . "\r\n";
        $ciudad->save();
        $auditoria->save();
        return view('index');
    }
}
