<?php

namespace App\Http\Controllers;

use Validator;
use App\Alojamiento;
use Illuminate\Http\Request;

class AlojamientoController extends Controller
{

    public function rules(){
        return[
        'ciudad_id' =>  'required|string',
        'nombre_alojamiento' => 'required|string',
        'numero_estrellas' => 'required|numeric',
        'calle_alojamiento' => 'required|string',
        'numero_alojamiento' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'ciudad_id' =>  'nullable|string',
        'nombre_alojamiento' => 'nullable|string',
        'numero_estrellas' => 'nullable|numeric',
        'calle_alojamiento' => 'nullable|string',
        'numero_alojamiento' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $alojamiento = Alojamiento::all();
        return $alojamiento;
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
        $alojamiento = Alojamiento::create($request->all());      
        $alojamiento->save();
        return $alojamiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $alojamiento = Alojamiento::find($id);
        return $alojamiento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Alojamiento $alojamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $alojamiento = Alojamiento::where('id', '=', $id)->first();
        $alojamiento->update($request->all());
        return $alojamiento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $alojamiento = Alojamiento::find($id);
        $alojamiento->delete();
        return "";
    }

    public function habitaciones($id)
    {
        $habitaciones = Alojamiento::with('habitacion')->find($id);
        return $habitaciones;
    }

    public function alojamientoPais(){
        //return request()->all();
        $pais = \App\Pais::where('nombre_pais','=',request()->pais)->first();
        if(empty($pais)){
            $alojamientos = [];
            return view('alojamientos.alojamientos', compact('alojamientos'));
        }
        $ciudades = \App\Ciudad::where('pais_id','=',$pais->id)->get();
        $alojamientos = [];
        foreach($ciudades as $c){
            $aux =  Alojamiento::where('ciudad_id',$c->id)->get();
                if(!empty($aux)){
                    foreach($aux as $a){
                        array_push($alojamientos,$a);
                }
            }
        }
        //$vuelos = App\Vuelo::where([['ciudad_va_id',$ciudadesD->id],['ciudad_viene_id',$ciudadesO->id]])->get();
        return view('alojamientos.alojamientos',compact('alojamientos'));
    }
}
