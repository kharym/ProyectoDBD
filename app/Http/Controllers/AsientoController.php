<?php

namespace App\Http\Controllers;

use Validator;
use App\Asiento;
use Illuminate\Http\Request;

class AsientoController extends Controller
{

    public function rules(){
        return[
        'vuelo_id' =>  'required|numeric',
        'numero_asiento' => 'required|numeric',
        'disponibilidad' => 'required|boolean',
        'tipo_asiento' => 'required|numeric',
        ];
}
        public function rules2(){
        return[
        'vuelo_id' =>  'nullable|numeric',
        'numero_asiento' => 'nullable|numeric',
        'disponibilidad' => 'nullable|boolean',
        'tipo_asiento' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asiento = Asiento::all();
        return $asiento;
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
        $asiento = Asiento::create($request->all());      
        $asiento->save();
        return $asiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $asiento = Asiento::find($id);
        return $asiento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Asiento $asiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $asiento = Asiento::where('id', '=', $id)->first();
        $asiento->update($request->all());
        return $asiento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Asiento  $asiento
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $asiento = Asiento::find($id);
        $asiento->delete();
        return "";
    }
}
