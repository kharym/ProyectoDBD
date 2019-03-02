<?php

namespace App\Http\Controllers;

use Validator;
use App\Paquete;
use Illuminate\Http\Request;
use DateTime;
use Session;
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
            if(request()->session()->has('rV')){
                    $i = $pasajeros - $numero;
                    $aux = request()->session()->get('rV')[0]->asiento_id;
                    $asiento = \App\Asiento::find($aux);
                    $asiento->disponibilidad = true;
                    $asiento->save();
                    Session::forget('rV');
                    Session::forget('psj');
                
            }
            $pasajeros = $numero;
            return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
        }
        else if($numero>-1){
            if(request()->session()->has('rV')){
                if(count(request()->session()->get('rV'))>$pasajeros-$numero){
                    $i = $pasajeros - $numero;
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

                        return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
                    }
                    
                }
            }
            request()->session()->push('rA',$reserva);     
            return view('paquete.compra-vuelo+auto',compact('id'));

        }
        return view('paquete.reserva-vuelo-auto',compact('id','pasajeros'));
    }
    //########################COMPRA VUELO+AUTO###############################
    public function comprarVueloAuto($id,$user){
        $paquete = \App\Paquete::find($id);
        $mensaje;
        
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $paquete->precio;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('carrito.compra-hecha', compact('mensaje'));
            }
        }
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        $compra = \App\Compra::create(['paquete_id'=>$id,'user_id'=>$user,'fecha_compra'=>$fecha, 'hora_compra'=>$hora]);
        for($i = 0; $i<count(request()->session()->get('rV')); $i++){
            $auxRV = request()->session()->get('rV')[$i];
            $auxP = request()->session()->get('psj')[$i];
            $auxP->save();
            $auxRV->pasajero_id = $auxP->id;
            $auxRV->save();
            $crv = \App\Paquete_ReservaVuelo::create(['paquete_id'=>$id,'reserva_vuelo_id'=>$auxRV->id]);
            $crv->save();
        }

        for($i = 0; $i<count(request()->session()->get('rA')); $i++){
            $auxRA = request()->session()->get('rA')[$i];
            $auxRA->save();
            $paquete->auto_id = $auxRA->id;
        }



        request()->session()->forget('rV');
        request()->session()->forget('rA');
        request()->session()->forget('psj');
        $mensaje = "Compra realizada con éxito";
        return view('paquete.compra-hecha',compact('mensaje'));
    }










    public function paquetesVueloAlojamiento(){
        $paquetes = \App\Paquete::where('auto_id',null)->get();
        return view('paquete.vuelo-alojamiento',compact('paquetes'));
    }

    public function reservaPaqueteVueloAlojamiento($id,$numero){
        $paquete = \App\Paquete::find($id);
        $vuelo_id = $paquete->vuelo_id; 
        $pasajeros = $paquete->pasajeros;
        if($numero == $pasajeros){
            if(request()->session()->has('rV')){
                    $i = $pasajeros - $numero;
                    $aux = request()->session()->get('rV')[0]->asiento_id;
                    $asiento = \App\Asiento::find($aux);
                    $asiento->disponibilidad = true;
                    $asiento->save();
                    Session::forget('rV');
                    Session::forget('psj');
                
            }
            $pasajeros = $numero;
            return view('paquete.reserva-vuelo-alojamiento',compact('id','pasajeros'));
        }
        else if($numero>-1){
            if(request()->session()->has('rV')){
                if(count(request()->session()->get('rV'))>$pasajeros-$numero){
                    $i = $pasajeros - $numero;
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

                        return view('paquete.reserva-vuelo-alojamiento',compact('id','pasajeros'));
                    }
                    
                }
            }
            request()->session()->push('rV',$reservaVuelo);
            request()->session()->push('psj',$pasajero);

            return view('paquete.reserva-vuelo-alojamiento',compact('id','pasajeros'));
        }
        else{
            $inicio = new DateTime(request()->start);
            $fin = new DateTime(request()->return);
            $dias = $fin->diff($inicio)->format("%a");
            
            $hab = \App\Habitacion::find($paquete->habitacion_id);

            $reserva = new \App\ReservaHabitacion();
            $reserva->habitacion_id = $hab->id;
            $reserva->precio_res_hab = $hab->precio*$dias;
            $reserva->fecha_llegada = request()->start;
            $reserva->fecha_ida = request()->return;
            $reserva->numero_ninos = request()->cantidad_ninos;
            $reserva->numero_adulto = request()->cantidad_adultos;

            if(request()->session()->has('rH')){
                foreach(request()->session()->get('rH') as $ra){
                    if($reserva->habitacion_id == $ra->habitacion_id){
                        return view('paquete.reserva-vuelo-alojamiento',compact('id','pasajeros'));
                    }
                    
                }
            }
            request()->session()->push('rH',$reserva);     
            return view('paquete.compra-vuelo+alojamiento',compact('id'));

        }
        return view('paquete.reserva-vuelo-alojamiento',compact('id','pasajeros'));
    }

    public function comprarVueloAlojamiento($id,$user){
        $paquete = \App\Paquete::find($id);
        $mensaje;
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $paquete->precio;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('carrito.compra-hecha', compact('mensaje'));
            }
        }
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        $compra = \App\Compra::create(['paquete_id'=>$id,'user_id'=>$user,'fecha_compra'=>$fecha, 'hora_compra'=>$hora]);
        for($i = 0; $i<count(request()->session()->get('rV')); $i++){
            $auxRV = request()->session()->get('rV')[$i];
            $auxP = request()->session()->get('psj')[$i];
            $auxP->save();
            $auxRV->pasajero_id = $auxP->id;
            $auxRV->save();
            $crv = \App\Paquete_ReservaVuelo::create(['paquete_id'=>$id,'reserva_vuelo_id'=>$auxRV->id]);
            $crv->save();
        }

        for($i = 0; $i<count(request()->session()->get('rH')); $i++){
            $auxRA = request()->session()->get('rH')[$i];
            $auxRA->save();
            $paquete->habitacion_id = $auxRA->id;
        }



        request()->session()->forget('rV');
        request()->session()->forget('rH');
        request()->session()->forget('psj');
        $mensaje = "Compra realizada con éxito";
        return view('paquete.compra-hecha',compact('mensaje'));
    }


    
}
