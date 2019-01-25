<?php

namespace App\Http\Controllers;

use Validator;
use App\Compra;
use Illuminate\Http\Request;

class CompraController extends Controller
{

    public function rules(){
        return[
        'usuario_id' =>  'required|numeric',
        'actividad_id' => 'required|numeric',
        'seguro_id' => 'required|numeric',
        'paquete_id' =>  'required|numeric',
        'reserva_auto_id' => 'required|numeric',
        'reserva_habitacion_id' => 'required|numeric',
        'fecha_compra' => 'required|date',
        'hora_compra' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'usuario_id' =>  'nullable|numeric',
        'actividad_id' => 'nullable|numeric',
        'seguro_id' => 'nullable|numeric',
        'paquete_id' =>  'nullable|numeric',
        'reserva_auto_id' => 'nullable|numeric',
        'reserva_habitacion_id' => 'nullable|numeric',
        'fecha_compra' => 'nullable|date',
        'hora_compra' => 'nullable|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra = Compra::all();
        return $compra;
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
        $compra = Compra::create($request->all());      
        $compra->save();
        return $compra;  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $compra = Compra::find($id);
        return $compra;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $compra = Compra::where('id', '=', $id)->first();
        $compra->update($request->all());
        return $compra;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $compra = Compra::find($id);
        $compra->delete();
        return "";
    }

    public function comprarVuelo($id, Request $request){
        return view('compra',compact('id'));
    }

    public function realizarCompra($id,  $name, $dni, $apellido, $asiento, $menor, $asistencia, $celular,$pais){
        $bol;
        $bol2;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        if($menor=="No"){
            $bol=False;
        }
        else{
            $bol=True;
        }
        if($asistencia=="No"){
            $bol2=False;
        }
        else{
            $bol2=True;
        }
        $as = \App\Asiento::where('vuelo_id',$id)->get();
        $asientoSeleccionado = $as->where('numero_asiento',$asiento)->first();
        $asientoSeleccionado->update(['disponibilidad' => False]);
        $asientoSeleccionado->save();
        $pasajero = \App\Pasajero::create(['name'=>$name,'apellido'=>$apellido,'dni_pasaporte'=>$dni,
        'menor_edad'=>$bol,'asistencia_especial'=>$bol2,'telefono'=>$celular,'pais'=>$pais,'movilidad_reducida'=>False]);
        $pasajero->save();
        $reservaVuelo = \App\ReservaVuelo::create(['vuelo_id'=>$id,'cantidad_pasajeros'=>1,'pasajero_id'=>$pasajero->id,
        'tipo_cabina'=>0,'cantidad_paradas'=>1,'fecha_reserva'=>$fecha,'hora_reserva'=>$hora]);
        $reservaVuelo->save();
        return view('compra-realizada');
    }
}
