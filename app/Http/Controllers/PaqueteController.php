<?php

namespace App\Http\Controllers;

use Validator;
use App\Paquete;
use Illuminate\Http\Request;
use DateTime;

class PaqueteController extends Controller
{



    public function rules(){
        return[
        'reserva_auto_id' =>  'required|numeric',
        'reserva_habitacion_id' => 'required|numeric',
        'precio' => 'required|numeric',
        'descuento' => 'required|numeric',
        'tipo_paquete' => 'required|numeric',
        'disponibilidad' => 'required|boolean',
        ];
    }

    public function rules2(){
        return[
        'reserva_auto_id' =>  'nullable|numeric',
        'reserva_habitacion_id' => 'nullable|numeric',
        'precio' => 'nullable|numeric',
        'descuento' => 'nullable|numeric',
        'tipo_paquete' => 'nullable|numeric',
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
        $paquete = Paquete::all();
        return $paquete;
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
        $paquete = Paquete::create($request->all());      
        $paquete->save();
        return $paquete;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $paquete = Paquete::find($id);
        return $paquete;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Paquete $paquete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $paquete = Paquete::where('id', '=', $id)->first();
        $paquete->update($request->all());
        return $paquete;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $paquete = Paquete::find($id);
        $paquete->delete();
        return "";
    }



    public function paquetesVueloAuto(){
        $paquetes = \App\Paquete::where('habitacion_id',null)->get();
        return view('paquete.vuelo-auto',compact('paquetes'));
    }

    public function reservaPaqueteVueloAuto($id,$numero){
        $paquete = \App\Paquete::find($id);
        $vuelo_id = $paquete->vuelo_id; 
        $pasajeros = $paquete->pasajeros;
        if($numero == $pasajeros){
            $pasajeros = $numero;
            return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
        }
        else if($numero!=0){
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
            $vuelo = \App\Vuelo::where('id',$paquete->vuelo_id)->first();
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
                        $pasajeros = $numero+1;
                        return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
                    }
                    
                }
            }
            request()->session()->push('rV',$reservaVuelo);
            request()->session()->push('psj',$pasajero);

            return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
        }
        else{
            $inicio = new DateTime(request()->start);
            $fin = new DateTime(request()->return);
            $dias = $fin->diff($inicio)->format("%a");
            
            $auto = \App\Auto::find($paquete->auto_id);

            $reserva = new \App\ReservaAuto();
            $reserva->auto_id = $auto->id;
            $reserva->precio_auto = $auto->precio*$dias;
            $reserva->fecha_recogido = request()->start;
            $reserva->fecha_devolucion = request()->end;
            $reserva->ubicacion_id = request()->retiro;
            $reserva->tipo_auto = 0;

            if(request()->session()->has('rA')){
                foreach(request()->session()->get('rA') as $ra){
                    if($reserva->auto_id == $ra->auto_id){
                        $pasajeros = $numero+1;
                        return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
                    }
                    
                }
            }
            request()->session()->push('rA',$reserva);     
            return view('paquete.compra-vuelo+auto',compact('id'));

        }
        return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
    }

    public function comprarVueloAuto($id){
        return view('paquete.compra-hecha');
    }
}
