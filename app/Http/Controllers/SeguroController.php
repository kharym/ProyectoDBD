<?php

namespace App\Http\Controllers;

use Validator;
use App\Seguro;
use Illuminate\Http\Request;

class SeguroController extends Controller
{

    public function rules(){
        return[
        'edad_pasajero' =>  'required|numeric',
        'ida_vuelta' => 'required|boolean',
        'cantidad_personas' =>  'required|numeric',
        'fecha_ida' => 'required|date',
        'fecha_vuelta' => 'required|date',
        'destino' => 'required|string',
        'costo_pasaje' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'edad_pasajero' =>  'nullable|numeric',
        'ida_vuelta' => 'nullable|boolean',
        'cantidad_personas' =>  'nullable|numeric',
        'fecha_ida' => 'nullable|date',
        'fecha_vuelta' => 'nullable|date',
        'destino' => 'nullable|string',
        'costo_pasaje' => 'nullable|numeric',
        ];
    }
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
        $validador = Validator::make($request->all(),$this->rules());
        if($validador->fails()){
            return $validador->messages();
        }
        $seguro = Seguro::create($request->all());      
        $seguro->save();
        return $seguro;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
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
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $seguro = Seguro::where('id', '=', $id)->first();
        $seguro->update($request->all());
        return $seguro;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Seguro  $seguro
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $seguro = Seguro::find($id);
        $seguro->delete();
        return "";
    }

    public function reservarSeguro(){
        return view('seguro.seguro');
    }

    public function comprarSeguro(){
        $seguro = new \App\Seguro();
        $seguro->edad_pasajero = request()->edad;
        $seguro->dni = request()->dni;
        if(request()->dental){
            $seguro->seguro_dental = true;
        }
        else{
            $seguro->seguro_dental = false;
        }

        if(request()->accidente){
            $seguro->seguro_accidentes = true;
        }
        else{
            $seguro->seguro_accidentes = false;
        }

        if(request()->equipaje){
            $seguro->perdida_equipaje = true;
        }
        else{
            $seguro->perdida_equipaje = false;
        }

        if(request()->asesoria_legal){
            $seguro->legal = true;
        }
        else{
            $seguro->legal = false;
        }

        if(request()->siniestro){
            $seguro->seguro_siniestros = true;
        }
        else{
            $seguro->seguro_siniestros = false;
        }

        if(request()->vuelo){
            $seguro->problemas_viaje = true;
        }

        else{
            $seguro->problemas_viaje = false;
        
        }
        $seguro->ida_vuelta = false;
        $seguro->cantidad_personas = 1;

        $seguro->fecha_ida = request()->fechaIda;
        $seguro->fecha_ida = request()->fechaVuelta;
        $seguro->costo_pasaje = request()->precio;
        $seguro->destino = "a";
        if(request()->session()->has('rS')){
            request()->session()->forget('rS');
            return redirect('/reservar-seguro');
        }
        request()->session()->push('rS',$seguro);
        return view('seguro.compra-seguro');
    }
}
