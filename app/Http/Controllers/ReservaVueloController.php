<?php

namespace App\Http\Controllers;
use Session;
use Validator;
use App\ReservaVuelo;
use Illuminate\Http\Request;

class ReservaVueloController extends Controller
{

    public function rules(){
        return[
        'vuelo_id' =>  'required|numeric',
        'asiento_id' => 'required|numeric',
        'pasajero_id' => 'required|numeric',
        'ida_vuelta' => 'required|boolean',
        'fecha_reserva' => 'required|date',
        'hora_reserva' => 'required|string',
        'precio_reserva_vuelo' => 'required|numeric',
        'cantidad_paradas' => 'required|numeric',
        'cantidad_pasajeros' => 'required|numeric',
        'tipo_cabina' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'vuelo_id' =>  'nullable|numeric',
        'asiento_id' => 'nullable|numeric',
        'pasajero_id' => 'nullable|numeric',
        'ida_vuelta' => 'nullable|boolean',
        'fecha_reserva' => 'nullable|date',
        'hora_reserva' => 'nullable|string',
        'precio_reserva_vuelo' => 'nullable|numeric',
        'cantidad_paradas' => 'nullable|numeric',
        'cantidad_pasajeros' => 'nullable|numeric',
        'tipo_cabina' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaVuelo = ReservaVuelo::all();
        return $reservaVuelo;
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
        $rv = ReservaVuelo::create($request->all());      
        $asiento = \App\Asiento::find($rv->asiento_id);
        $asiento->disponibilidad = false;
        $asiento->save();
        return "Reserva realizada con éxito";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $reservaVuelo = ReservaVuelo::find($id);
        return $reservaVuelo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservaVuelo $reservaVuelo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $rV = ReservaAuto::where('id', '=', $id)->first();
        $rV->update($request->all());
        return $rV;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservaVuelo  $reservaVuelo
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $reservaVuelo = ReservaVuelo::find($id);
        $reservaVuelo->delete();
        return "";
    }

    public function reserva($id, $numero){
        if($numero == -4){
            request()->session()->push('cantidad',request()->cantidad);
            if(request()->session()->has('rV')){
                    $i = request()->cantidad - $numero;
                    $aux = request()->session()->get('rV')[0]->asiento_id;
                    $asiento = \App\Asiento::find($aux);
                    $asiento->disponibilidad = true;
                    $asiento->save();
                    Session::forget('rV');
                    Session::forget('psj');
                
            }
            $pasajeros = request()->cantidad;
            return view('vuelos.reserva',compact('id','pasajeros'));
        }
        else if($numero>=0){
            $p = request()->session()->get('cantidad')[0];
            if(request()->session()->has('rV')){
                if(count(request()->session()->get('rV'))>$p-$numero){
                    $i = $p - $numero;
                    $aux = request()->session()->get('rV')[$i]->asiento_id;
                    $asiento = \App\Asiento::find($aux);
                    $asiento->disponibilidad = true;
                    $asiento->save();
                    Session::forget('rV.' . $i);
                    Session::forget('psj.' . $i);
                }
            }
            $pasajeros = $numero;
            $bol;
            $bol2;
            $fecha = date('Y-m-d');
            $hora = date("H:i:s");
            if(request()->menor=='No'){
                $bol=False;
            }
            else{
                $bol=True;
            }
            if(request()->asistencia == 'No'){
                $bol2=False;
            }
            else{
                $bol2=True;
            }
            $vuelo = \App\Vuelo::where('id',$id)->first();
            $as = \App\Asiento::where('vuelo_id',$vuelo->id)->get();
            $asientoSeleccionado = $as->where('numero_asiento',request()->asiento)->first();
            $asientoSeleccionado->disponibilidad = false;
            $asientoSeleccionado->save(); 
            $pasajero = new \App\Pasajero();
            $pasajero->name = request()->name;
            $pasajero->apellido=request()->apellido;
            $pasajero->dni_pasaporte=request()->dni;
            $pasajero->menor_edad=$bol;
            $pasajero->asistencia_especial=$bol2;
            $pasajero->telefono=request()->celular;
            $pasajero->pais=request()->pais;
            $pasajero->movilidad_reducida=False;
    
            $reservaVuelo = new \App\ReservaVuelo();
            $reservaVuelo->cantidad_pasajeros=1;
            $reservaVuelo->pasajero_id=$pasajero->id;
            $reservaVuelo->asiento_id=$asientoSeleccionado->id;
            $reservaVuelo->vuelo_id=$vuelo->id;
            $reservaVuelo->tipo_cabina=0;
            $reservaVuelo->cantidad_paradas=1;
            $reservaVuelo->fecha_reserva=$fecha;
            $reservaVuelo->hora_reserva=$hora;
            $reservaVuelo->precio_reserva_vuelo=$vuelo->precio_vuelo;
            $reservaVuelo->ida_vuelta=False;
            if(request()->session()->has('rV')){
                foreach(request()->session()->get('rV') as $rv){
                    if($reservaVuelo->asiento_id == $rv->asiento_id){

                        return redirect('/');
                    }
                    
                }
            }
            request()->session()->push('rV',$reservaVuelo);
            request()->session()->push('psj',$pasajero);
            if($numero == 0){
                return view('vuelos.compra',compact('id','pasajeros'));
            }
            return view('vuelos.reserva',compact('id','pasajeros'));
        }




        return view('vuelos.reserva',compact('id'));
    }

    public function carritoCompraVuelo(Request $request,$id){
        $bol;
        $bol2;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        if(request()->menor=='No'){
            $bol=False;
        }
        else{
            $bol=True;
        }
        if(request()->asistencia == 'No'){
            $bol2=False;
        }
        else{
            $bol2=True;
        }
        $vuelo = \App\Vuelo::where('id',$id)->first();
        $as = \App\Asiento::where('vuelo_id',$id)->get();
        $asientoSeleccionado = $as->where('numero_asiento',request()->asiento)->first();

        $pasajero = new \App\Pasajero();
        $pasajero->name = request()->name;
        $pasajero->apellido=request()->apellido;
        $pasajero->dni_pasaporte=request()->dni;
        $pasajero->menor_edad=$bol;
        $pasajero->asistencia_especial=$bol2;
        $pasajero->telefono=request()->celular;
        $pasajero->pais=request()->pais;
        $pasajero->movilidad_reducida=False;

        $reservaVuelo = new \App\ReservaVuelo();
        $reservaVuelo->cantidad_pasajeros=1;
        $reservaVuelo->pasajero_id=$pasajero->id;
        $reservaVuelo->asiento_id=$asientoSeleccionado->id;
        $reservaVuelo->vuelo_id=$id;
        $reservaVuelo->tipo_cabina=0;
        $reservaVuelo->cantidad_paradas=1;
        $reservaVuelo->fecha_reserva=$fecha;
        $reservaVuelo->hora_reserva=$hora;
        $reservaVuelo->precio_reserva_vuelo=$vuelo->precio_vuelo;
        $reservaVuelo->ida_vuelta=False;

        /*if($request->session()->get('reservaVuelo')[0] === NULL){
            $request->session()->get('reservaVuelo')[0] = $reservaVuelo;
            $request->session()->get('pasajero')[0] = $pasajero;
            return view('vuelos.prueba');
        }*/
        //else{
            foreach($request->session()->get('reservaVuelo') as $rv){
                if(!is_null($rv)){
                    if($reservaVuelo->asiento_id == $rv->asiento_id){
                        return view('carrito.carrito');
                    }
                }
            }
        //}
        $request->session()->push('reservaVuelo',$reservaVuelo);        
        $request->session()->push('pasajero',$pasajero);        
        return view('carrito.carrito');
    }

}
