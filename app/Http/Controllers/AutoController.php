<?php

namespace App\Http\Controllers;

use Validator;
use App\Auto;
use Illuminate\Http\Request;

class AutoController extends Controller
{

    public function rules(){
        return[
        'empresa_id' =>  'required|numeric',
        'numero_puertas' => 'required|numeric',
        'tipo_transmision' => 'required|numeric',
        'numero_asientos' => 'required|numeric',
        'modelo' => 'required|string',
        'marca' => 'required|string',
        'disponibilidad' => 'required|boolean',
        ];
    }

    public function rules2(){
        return[
        'empresa_id' =>  'nullable|numeric',
        'numero_puertas' => 'nullable|numeric',
        'tipo_transmision' => 'nullable|numeric',
        'numero_asientos' => 'nullable|numeric',
        'modelo' => 'nullable|string',
        'marca' => 'nullable|string',
        'disponibilidad' => 'nullable|boolean',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $autos = Auto::all();
        
        return view('vehiculos.autosAll',compact('autos'));
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
        $auto = Auto::create($request->all());      
        $auto->save();
        return $auto;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $auto = Auto::find($id);
        return $auto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function edit(Auto $auto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $auto = Auto::where('id', '=', $id)->first();
        $auto->update($request->all());
        return $auto;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Auto  $auto
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $auto = Auto::find($id);
        $auto->delete();
        return "";
    }

    public function autosPais()
    {
        $pais = \App\Pais::where('nombre_pais','=',request()->pais)->first();
        if(empty($pais)){
            $autos = [];
            return view('autos', compact('autos'));
        }
        $ciudades = \App\Ciudad::where('pais_id','=',$pais->id)->get();
        $empresas = [];
        foreach($ciudades as $ciudad){
            $empresa = \App\Empresa::where('ciudad_id','=',$ciudad->id)->get();
            foreach($empresa as $e){
                array_push($empresas,$e);
            }
        }
        $autos = [];
        foreach($empresas as $e){
            $auto = Auto::where([['empresa_id','=',$e->id],['marca','=',request()->marca]])->get();
            foreach($auto as $a){
                array_push($autos,$a);
            }
        }
        return view('vehiculos.autos',compact('autos'));
    }

    public function vista($id){
        return view('vehiculos.auto-reserva', compact('id'));
    }
}
