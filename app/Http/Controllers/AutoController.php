<?php

namespace App\Http\Controllers;

use Validator;
use App\Auto;
use Illuminate\Http\Request;
use DateTime;
use Date;

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
        return view('admin.agregar-auto');
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

    public function autosFecha()
    {
        if(request()->session()->has('start')){
            request()->session()->forget('start');
        }
        if(request()->session()->has('return')){
            request()->session()->forget('return');
        }
        request()->session()->push('start',request()->start);

        request()->session()->push('return',request()->return);

        $start = new DateTime(request()->session()->get('start')[0]);
        $return = new DateTime(request()->session()->get('return')[0]);
        $start = Date($start->format('Y-m-d'));
        $return = Date($return->format('Y-m-d'));
        $aut = \App\Auto::all();
        $autosAux = [];
        foreach($aut as $auto){
            $empresa = \App\Empresa::find($auto->empresa_id);
            $ub = \App\Ubicacion::find($empresa->ubicacion_id);
            $ciudad = \App\Ciudad::find($ub->ciudad_id);
            if($ciudad->id == request()->ciudad){
                array_push($autosAux,$auto);
            }
        }
        $reservas = \App\ReservaAuto::all();
        $re = [];
        foreach($reservas as $reserva){
            $s = Date($reserva->fecha_recogido);
            $r = Date($reserva->fecha_devolucion);
            if( !( ($s>$return && $r>$return)   || ($s<$start && $r<$start) )){
                array_push($re,$reserva);
            }
        }
        $ha = [];
        foreach($re as $r){
           $hab = Auto::find($r->auto_id);
           array_push($ha,$hab); 
        }
        $autos = [];
        $ha = array_unique($ha);
        if(empty($ha)){
            $autos = $autosAux;
            return view('vehiculos.autos',compact('autos'));
        }
        foreach($autosAux as $auto){
            if(!in_array($auto,$ha)){
                array_push($autos,$auto);
            }
        }
        return view('vehiculos.autos',compact('autos'));
    }

    public function vista($id){
        return view('vehiculos.auto-reserva', compact('id'));
    }

    public function agregarAuto(){
        $auto = new Auto();
        $tipoTransmision = request()->tipoTransmision;
        $disponibilidad = request()->disponibilidad;

        $auto->empresa_id = request()->empresaVehiculo;
        $auto->numero_puertas = request()->numeroPuertas;
        $auto->numero_asientos = request()->numeroAsientos;
        $auto->modelo = request()->modelo;
        $auto->marca = request()->marca;
        $auto->precio = request()->precio;

        if ($tipoTransmision == '1'){
            $auto->tipo_transmision = 0;
        }
        else{

            $auto->tipo_transmision = 1;
        }

        if ($disponibilidad == '1'){
            $auto->disponibilidad = true;
        }
        else{

            $auto->disponibilidad = false;
        }

        $auto->save();

        $autos = Auto::all();

        return view('vehiculos.autosAll', compact('autos'));


    }
}
