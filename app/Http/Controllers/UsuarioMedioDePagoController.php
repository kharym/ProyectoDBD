<?php

namespace App\Http\Controllers;

use App\Usuario_MedioDePago;
use Illuminate\Http\Request;

class UsuarioMedioDePagoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario_medioDePago = Usuario_MedioDePago::all();
        return $usuario_medioDePago;
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
        $uMdP = Usuario_MedioDePago::all();
        if ($uMdP) 
        {
            return $uMdP; 
        } 
        else 
        {
            $response = ['error' => 'Ha ocurrido un error en la Base de Datos al actualizar!'];
            return $response;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario_MedioDePago  $usuario_MedioDePago
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $usuario_medioDePago = Usuario_MedioDePago::find($id);
        return $usuario_medioDePago;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario_MedioDePago  $usuario_MedioDePago
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuario_MedioDePago $usuario_MedioDePago)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario_MedioDePago  $usuario_MedioDePago
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuario_MedioDePago $usuario_MedioDePago)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $mp = Usuario_MedioDePago::where('id', '=', $id)->first();
        $mp->update($request->all());
        return $mp;
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario_MedioDePago  $usuario_MedioDePago
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $usuario_medioDePago = Usuario_MedioDePago::find($id);
        $usuario_medioDePago->delete();
        return "";
    }
}
