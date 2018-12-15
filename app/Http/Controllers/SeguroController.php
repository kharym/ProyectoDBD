<?php

namespace App\Http\Controllers;

use App\Seguro;
use Illuminate\Http\Request;

class SeguroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seguro = Seguro::all();
        return $seguro;
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
        $seguro = Seguro::create($request->all());
        $seguro->save();
        return "";  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function show(Seguro $id)
    {
        $seguro = Seguro::find($id);
        return $seguro;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function edit(Seguro $seguro)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Seguro $seguro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seguro $id)
    {
        $seguro = Seguro::find($id);
        $seguro->delete();
        return "";
    }
}
