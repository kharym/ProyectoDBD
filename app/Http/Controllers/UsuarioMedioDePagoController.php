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
        $usuario_medioDePago = Usuario_MedioDePago::create($request->all());
        $usuario_medioDePago->save();
        return "";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario_MedioDePago  $usuario_MedioDePago
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario_MedioDePago $id)
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario_MedioDePago  $usuario_MedioDePago
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario_MedioDePago $id)
    {
        $usuario_medioDePago = Usuario_MedioDePago::find($id);
        $usuario_medioDePago->delete();
        return "";
    }
}
