<?php

namespace App\Http\Controllers;

use App\ReservaHabitacion;
use Illuminate\Http\Request;

class ReservaHabitacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaHabitacion = ReservaHabitacion::all();
        return $reservaHabitacion;
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
        $reservaHabitacion = ReservaHabitacion::create($request->all());
        $reservaHabitacion->save();
        return ""; 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function show(ReservaHabitacion $id)
    {
        $reservaHabitacion = ReservaHabitacion::find($id);
        return $reservaHabitacion;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservaHabitacion $reservaHabitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReservaHabitacion $reservaHabitacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservaHabitacion  $reservaHabitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservaHabitacion $id)
    {
        $reservaHabitacion = ReservaHabitacion::find($id);
        $reservaHabitacion->delete();
        return "";
    }
}
