<?php

namespace App\Http\Controllers;

use App\MedioDePago;
use Illuminate\Http\Request;

class MedioDePagoController extends Controller
{
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
        $medioDePago = MedioDePago::create($request->all());
        if ($medioDePago) 
        {
            return $medioDePago; 
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
    public function update(Request $request, MedioDePago $medioDePago)
    {
        //
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
