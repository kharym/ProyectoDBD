<?php

namespace App\Http\Controllers;

use Validator;
use App\CuentaBancaria;
use Illuminate\Http\Request;

class CuentaBancariaController extends Controller
{


    public function rules(){
        return[
        'usuario_id' =>  'required|numeric',
        'saldo' => 'required|numeric',
        'max_giro' => 'required|numeric'
        'nombre_banco' =>  'required|string',
        'fecha_giro' => 'required|date',
        'hora_giro' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'usuario_id' =>  'nullable|numeric',
        'saldo' => 'nullable|numeric',
        'max_giro' => 'nullable|numeric'
        'nombre_banco' =>  'nullable|string',
        'fecha_giro' => 'nullable|date',
        'hora_giro' => 'nullable|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuentaBancaria = CuentaBancaria::all();
        return $cuentaBancaria;
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
        $cb = CuentaBancaria::create($request->all());      
        $cb->save();
        return $cb;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $cuentaBancaria = CuentaBancaria::find($id);
        return $cuentaBancaria;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function edit(CuentaBancaria $cuentaBancaria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $cuentaBancaria = cuentaBancaria::where('id', '=', $id)->first();
        $cuentaBancaria->update($request->all());
        return $cuentaBancaria;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CuentaBancaria  $cuentaBancaria
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $cuentaBancaria = CuentaBancaria::find($id);
        $cuentaBancaria->delete();
        return "";
    }
}
