<?php

namespace App\Http\Controllers;

use Validator;
use App\Auditoria;
use Illuminate\Http\Request;

class AuditoriaController extends Controller
{

    public function rules(){
        return[
        'tipo_auditoria' =>  'required|string',
        'descripcion' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'tipo_auditoria' =>  'nullable|string',
        'descripcion' => 'nullable|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditorias = Auditoria::all();
        return view('admin.auditoriaAll', compact('auditorias'));
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
        $auditoria = Auditoria::create($request->all());      
        $auditoria->save();
        return $auditoria;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auditoria  $auditoria
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $auditoria = Auditoria::find($id);
        return $auditoria;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auditoria  $auditoria
     * @return \Illuminate\Http\Response
     */
    public function edit(Auditoria $auditoria)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auditoria  $auditoria
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $auditoria = Auditoria::where('id', '=', $id)->first();
        $auditoria->update($request->all());
        return $auditoria;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auditoria  $auditoria
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $auditoria = Auditoria::find($id);
        $auditoria->delete();
        return "";
    }
}
