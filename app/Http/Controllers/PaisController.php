<?php

namespace App\Http\Controllers;

use Validator;
use App\Pais;
use Illuminate\Http\Request;

class PaisController extends Controller
{

    public function rules(){
        return[
        'nombre_pais' =>  'required|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pais = Pais::all();
        return $pais;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agregar-pais');
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
        $pais = Pais::create($request->all());      
        $pais->save();
        return $pais;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $pais = Pais::find($id);
        return $pais;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function edit(Pais $pais)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pais $pais)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pais  $pais
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $pais = Pais::find($id);
        $pais->delete();
        return "";
    }

    public function agregarPais(){
        $pais = new Pais();

        $pais->nombre_pais = request()->nombrePais;
        $pais->save();

        return view('index');
    }
}
