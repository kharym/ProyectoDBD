<?php

namespace App\Http\Controllers;

use Validator;
use App\MedioDePago;
use Illuminate\Http\Request;

class MedioDePagoController extends Controller
{

    public function rules(){
        return[
        'tipo_medioPago' =>  'required|numeric',
        'disponibilidad' =>  'required|boolean',
        'monto' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'tipo_medioPago' =>  'nullable|numeric',
        'disponibilidad' =>  'nullable|boolean',
        'monto' => 'nullable|numeric',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medioDePago = MedioDePago::all();
        return $medioDePago;
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
        $mp = MedioDePago::create($request->all());      
        $mp->save();
        return $mp;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedioDePago  $medioDePago
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $medioDePago = MedioDePago::find($id);
        return $medioDePago;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedioDePago  $medioDePago
     * @return \Illuminate\Http\Response
     */
    public function edit(MedioDePago $medioDePago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedioDePago  $medioDePago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $mp = MedioDePago::where('id', '=', $id)->first();
        $mp->update($request->all());
        return $mp;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedioDePago  $medioDePago
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $medioDePago = MedioDePago::find($id);
        $medioDePago->delete();
        return "";
    }
}
