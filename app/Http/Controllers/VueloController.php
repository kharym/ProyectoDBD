<?php

namespace App\Http\Controllers;

use Validator;
use App\Vuelo;
use Illuminate\Http\Request;

class VueloController extends Controller
{
 
    public function rules(){
        return[
        'ciudad_va_id' =>  'required|numeric',
        'ciudad_viene_id' => 'required|numeric',
        'origen' => 'required|string',
        'destino' => 'required|string',
        'precio_vuelo' => 'required|numeric',
        'cantidad_asientos' => 'required|numeric',
        'fecha_ida' => 'required|date',
        'hora_ida' => 'required|string',
        'fecha_llegada' => 'required|date',
        'hora_llegada' => 'required|string',
        'duracion_viaje' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'ciudad_va_id' =>  'nullable|numeric',
        'ciudad_viene_id' => 'nullable|numeric',
        'origen' => 'nullable|string',
        'destino' => 'nullable|string',
        'precio_vuelo' => 'nullable|numeric',
        'cantidad_asientos' => 'nullable|numeric',
        'fecha_ida' => 'nullable|date',
        'hora_ida' => 'nullable|string',
        'fecha_llegada' => 'nullable|date',
        'hora_llegada' => 'nullable|string',
        'duracion_viaje' => 'nullable|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vuelo = Vuelo::all();
        return view('vuelos',content('vuelo'));
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
        $vuelo = Vuelo::create($request->all());      
        $vuelo->save();
        return $vuelo;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $vuelo = Vuelo::find($id);
        return $vuelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(Vuelo $vuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $vuelo = Vuelo::where('id', '=', $id)->first();
        $vuelo->update($request->all());
        return $vuelo;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vuelo  $vuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $vuelo = Vuelo::find($id);
        $vuelo->delete();
        return "";
    }

    public function asientos( $id)
    {
        $asientos = Vuelo::with('asiento')->find($id);
        return $asientos;
    }

  

    public function asientosDisponibles( $id)
    {
        $asientos = Vuelo::with('asiento')->find($id)->where( 'disponibilidad', true )->get();
      /*  $asientos = Vuelo::with('asiento')->find($id);
        $disponibles = []
        for()
        {
            $disponibilidad = Asiento::find($asientos[i]->id_asiento)
                                ->where('disponibilidad','=','true');
            $disponibles.add($disponibilidad);            
        }*/
        return $diponibles;
    }

    public function vuelosOrigenDestino(){
        //return request()->all();
        $paisO = \App\Pais::where('nombre_pais','=',request()->paisOrigen)->first();
        $paisD = \App\Pais::where('nombre_pais','=',request()->paisDestino)->first();
        $ciudadesO = \App\Ciudad::where('pais_id','=',$paisO->id)->get();
        $ciudadesD = \App\Ciudad::where('pais_id','=',$paisD->id)->get();
        $vuelos = [];
        foreach($ciudadesO as $co){
            foreach($ciudadesD as $cd){
                $aux =  \App\Vuelo::where([['ciudad_va_id',$cd->id],['ciudad_viene_id',$co->id]])->get();
                if(!empty($aux)){
                    foreach($aux as $a){
                        array_push($vuelos,$a);
                    }
                }
            }
        }
       //$vuelos = App\Vuelo::where([['ciudad_va_id',$ciudadesD->id],['ciudad_viene_id',$ciudadesO->id]])->get();
        return $vuelos;
    }

}
