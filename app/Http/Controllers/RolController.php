<?php

namespace App\Http\Controllers;

use Validator;
use App\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function rules(){
        return[
        'tipo_rol' =>  'required|numeric',
        'descripcion' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'tipo_rol' =>  'nullable|numeric',
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
        $rol = Rol::all();
        return $rol;
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
        $rol = Rol::create($request->all());      
        $rol->save();
        return $rol;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $rol = Rol::find($id);
        return $rol;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $rol = Rol::where('id', '=', $id)->first();
        $rol->update($request->all());
        return $rol;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rol  $rol
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $rol = Rol::find($id);
        $rol->delete();
        return "";
    }

     public function rols( $id)
    {
        $users = Rol::with('user')->find($id);
        return $users;
    }
}
