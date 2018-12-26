<?php

namespace App\Http\Controllers;

use Validator;
use App\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{

    public function rules(){
        return[
        'empresa_id' =>  'required|numeric',
        'numero_puertas' => 'required|numeric',
        'tipo_transmision' => 'required|numeric',
        'numero_asientos' => 'required|numeric',
        'modelo' => 'required|string',
        'marca' => 'required|string',
        'disponibilidad' => 'required|boolean',
        ];
    }

    public function rules2(){
        return[
        'empresa_id' =>  'nullable|numeric',
        'numero_puertas' => 'nullable|numeric',
        'tipo_transmision' => 'nullable|numeric',
        'numero_asientos' => 'nullable|numeric',
        'modelo' => 'nullable|string',
        'marca' => 'nullable|string',
        'disponibilidad' => 'nullable|boolean',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auto = Auto::all();
        return $auto;
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
        $auto = Auto::create($request->all());      
        $auto->save();
        return $auto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $auto = Auto::find($id);
        return $auto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function edit(Auto $auto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $auto = Auto::where('id', '=', $id)->first();
        $auto->update($request->all());
        return $auto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $auto = Auto::find($id);
        $auto->delete();
        return "";
    }
}
