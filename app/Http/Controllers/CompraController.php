<?php

namespace App\Http\Controllers;

use Validator;
use App\Compra;
use Illuminate\Http\Request;
use DateTime;
use Illuminate\Support\Facades\Mail;

class CompraController extends Controller
{

    public function rules(){
        return[
        'usuario_id' =>  'required|numeric',
        'actividad_id' => 'required|numeric',
        'seguro_id' => 'required|numeric',
        'paquete_id' =>  'required|numeric',
        'reserva_auto_id' => 'required|numeric',
        'reserva_habitacion_id' => 'required|numeric',
        'fecha_compra' => 'required|date',
        'hora_compra' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'usuario_id' =>  'nullable|numeric',
        'actividad_id' => 'nullable|numeric',
        'seguro_id' => 'nullable|numeric',
        'paquete_id' =>  'nullable|numeric',
        'reserva_auto_id' => 'nullable|numeric',
        'reserva_habitacion_id' => 'nullable|numeric',
        'fecha_compra' => 'nullable|date',
        'hora_compra' => 'nullable|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra = Compra::all();
        return $compra;
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
        $compra = Compra::create($request->all());      
        $compra->save();
        return $compra;  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $compra = Compra::find($id);
        return $compra;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $compra = Compra::where('id', '=', $id)->first();
        $compra->update($request->all());
        return $compra;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Compra  $compra
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $compra = Compra::find($id);
        $compra->delete();
        return "";
    }

    public function comprarVuelo($id, Request $request){
        $mensaje;
        $vuelo = \App\Vuelo::find(request()->session()->get('rV')[0]->vuelo_id);
        $precio =  $vuelo->precio_vuelo;
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $precio;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('carrito.compra-hecha', compact('mensaje'));
            }
        }
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        for($i = 0; $i<count(request()->session()->get('rV')); $i++){
            $data = [];
            $compra = Compra::create(['user_id'=>auth()->user()->id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora]);
            $auxRV = request()->session()->get('rV')[$i];
            $auxP = request()->session()->get('psj')[$i];
            $auxP->save();
            $auxRV->pasajero_id = $auxP->id;
            $auxRV->save();
            $crv = \App\Compra_ReservaVuelo::create(['compra_id'=>$compra->id,'reserva_vuelo_id'=>$auxRV->id]);
            $crv->save();
            array_push($data,$auxRV);
            Mail::send('mails.vuelo',['data'=>$data],function($message){
                $message->from('juaninhanjarry@gmail.com','Reserva Vuelo');
                $message->to(auth()->user()->email)->subject('compra realizada');
            });
        }
        $mensaje = "Compra realizada con éxito";
        request()->session()->forget('rV');
        request()->session()->forget('psj');
        return view('vuelos.compra-hecha',compact('id','mensaje'));
    }

    public function realizarCompra($id,  $name, $dni, $apellido, $asiento, $menor, $asistencia, $celular,$pais){
        $bol;
        $bol2;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        if($menor=="No"){
            $bol=False;
        }
        else{
            $bol=True;
        }
        if($asistencia=="No"){
            $bol2=False;
        }
        else{
            $bol2=True;
        }

        $vuelo = \App\Vuelo::where('id',$id)->first();
        $medioDePago = \App\MedioDePago::where('id',request()->numero)->first();
        $montoNuevo = $medioDePago->monto - $vuelo->precio_vuelo;
        $medioDePago->update(['monto'=>$montoNuevo]);
        $medioDePago->save();
        $as = \App\Asiento::where('vuelo_id',$id)->get();
        $asientoSeleccionado = $as->where('numero_asiento',$asiento)->first();
        $asientoSeleccionado->update(['disponibilidad' => False]);
        $asientoSeleccionado->save();
        $pasajero = \App\Pasajero::create(['name'=>$name,'apellido'=>$apellido,'dni_pasaporte'=>$dni,
        'menor_edad'=>$bol,'asistencia_especial'=>$bol2,'telefono'=>$celular,'pais'=>$pais,'movilidad_reducida'=>False]);
        $pasajero->save();
        $reservaVuelo = \App\ReservaVuelo::create(['vuelo_id'=>$id,'cantidad_pasajeros'=>1,'pasajero_id'=>$pasajero->id,'asiento_id'=>$asientoSeleccionado->id,
        'tipo_cabina'=>0,'cantidad_paradas'=>1,'fecha_reserva'=>$fecha,'hora_reserva'=>$hora, 'precio_reserva_vuelo'=>$vuelo->precio_vuelo,'ida_vuelta'=>False]);
        $reservaVuelo->save();
        $compra = \App\Compra::create(['fecha_compra'=>$fecha,'hora_compra'=>$hora]);
        $compra->save();
        $crv = \App\Compra_ReservaVuelo::create(['compra_id'=>$compra->id,'reserva_vuelo_id'=>$reservaVuelo->id]);
        $crv->save();
        return view('compra-realizada',compact('reservaVuelo'));
    }

    public function realizarCompraVueloAuth($id,  $name, $dni, $apellido, $asiento, $menor, $asistencia, $celular,$pais, $idU){
        $bol;
        $bol2;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        if($menor=="No"){
            $bol=False;
        }
        else{
            $bol=True;
        }
        if($asistencia=="No"){
            $bol2=False;
        }
        else{
            $bol2=True;
        }
        $cuenta = \App\CuentaBancaria::where('user_id',$idU)->first();
        $vuelo = \App\Vuelo::where('id',$id)->first();
        $medioDePago = \App\MedioDePago::where('id',request()->numero)->first();
        $montoNuevo = $cuenta->saldo - $vuelo->precio_vuelo;
        $cuenta->update(['saldo'=>$montoNuevo]);
        $cuenta->save();
        $as = \App\Asiento::where('vuelo_id',$id)->get();
        $asientoSeleccionado = $as->where('numero_asiento',$asiento)->first();
        $asientoSeleccionado->update(['disponibilidad' => False]);
        $asientoSeleccionado->save();
        $pasajero = \App\Pasajero::create(['name'=>$name,'apellido'=>$apellido,'dni_pasaporte'=>$dni,
        'menor_edad'=>$bol,'asistencia_especial'=>$bol2,'telefono'=>$celular,'pais'=>$pais,'movilidad_reducida'=>False]);
        $pasajero->save();
        $reservaVuelo = \App\ReservaVuelo::create(['vuelo_id'=>$id,'cantidad_pasajeros'=>1,'pasajero_id'=>$pasajero->id,'asiento_id'=>$asientoSeleccionado->id,
        'tipo_cabina'=>0,'cantidad_paradas'=>1,'fecha_reserva'=>$fecha,'hora_reserva'=>$hora, 'precio_reserva_vuelo'=>$vuelo->precio_vuelo,'ida_vuelta'=>False]);
        $reservaVuelo->save();
        $compra = \App\Compra::create(['user_id'=>$idU,'fecha_compra'=>$fecha,'hora_compra'=>$hora]);
        $compra->save();
        $crv = \App\Compra_ReservaVuelo::create(['compra_id'=>$compra->id,'reserva_vuelo_id'=>$reservaVuelo->id]);
        $crv->save();
        return view('compra-realizada',compact('reservaVuelo'));
    }


    public function comprarHabitacion($id){
        $inicio = new DateTime(request()->start);
        $fin = new DateTime(request()->return);
        if($inicio>$fin){
            return redirect('/');
        }

        $inicio = Date($inicio->format('Y-m-d'));
        $fin = Date($fin->format('Y-m-d'));
        $reservas = \App\ReservaHabitacion::where('habitacion_id',$id)->get();
        foreach($reservas as $r){
            $i = Date($r->fecha_llegada);
            $f = Date($r->fecha_ida);
            if( !( ($i<$inicio && $f<$inicio) || ($i>$fin && $f>$fin )) ){
                $mensaje = "No se puede reservar en la fecha indicada";
                return view('alojamientos.compra-hecha' ,compact('mensaje'));
            }
        }
        //######################################Validacion#################################
        
        $inicio = new DateTime(request()->start);
        $fin = new DateTime(request()->return);
        $dias = $fin->diff($inicio)->format("%a");
        
        $hab = \App\Habitacion::find($id);

        $reserva = new \App\ReservaHabitacion();
        $reserva->habitacion_id = $id;
        $reserva->precio_res_hab = $hab->precio*$dias;
        $reserva->fecha_llegada = request()->start;
        $reserva->fecha_ida = request()->return;
        $reserva->numero_ninos = request()->cantidad_ninos;
        $reserva->numero_adulto = request()->cantidad_adultos;
        if(!request()->session()->has('reservaHab') ){
            request()->session()->push('reservaHab',$reserva);
        }
        return view('alojamientos.compra',compact('id','dias'));
    }

    public function realizarCompraHabitacion($id){
        $mensaje;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        $reserva = request()->session()->get('reservaHab')[0];
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $reserva->precio_res_hab;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('alojamiento.compra-hecha', compact('mensaje'));
            }
        }
        $reserva->save();
        request()->session()->forget('reservaHab');
        $compra = Compra::create(['user_id'=>auth()->user()->id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_habitacion_id'=>$reserva->id]);
        $mensaje = "Reserva comprada con éxito";
        $data = [];
        array_push($data,$reserva);
        Mail::send('mails.habitacion',['data'=>$data],function($message){
            $message->from('juaninhanjarry@gmail.com','Reserva Habitación');
            $message->to(auth()->user()->email)->subject('compra realizada');
        });
        return view('alojamientos.compra-hecha', compact('mensaje'));
    }

    public function comprarVehiculo($id){
        $inicio = new DateTime(request()->start);
        $fin = new DateTime(request()->end);
        $inicio = Date($inicio->format('Y-m-d'));
        $fin = Date($fin->format('Y-m-d'));
        if($inicio>$fin){
            
            return redirect('/');
        }
        $inicio = new DateTime(request()->start);
        $fin = new DateTime(request()->end);
        $dias = $fin->diff($inicio)->format("%a");
        $inicio = Date($inicio->format('Y-m-d'));
        $fin = Date($fin->format('Y-m-d'));
        $auto = \App\Auto::find($id);

        $reservas = \App\ReservaAuto::where('auto_id',$id)->get();
        foreach($reservas as $r){
            $i = Date($r->fecha_recogido);
            $f = Date($r->fecha_devolucion);
            if(!( ($i<$inicio && $f<$inicio) || ($i>$fin && $f>$fin )) ) {
                $mensaje = "No se puede reservar el auto en el periodo indicado";
                return view('vehiculos.compra-hecha',compact('mensaje'));
            }
        }

        //################################Despues de la comprobacion####################################
        $reserva = new \App\ReservaAuto();
        $reserva->auto_id = $id;
        $reserva->precio_auto = $auto->precio*$dias;
        $reserva->fecha_recogido = request()->start;
        $reserva->fecha_devolucion = request()->end;
        $reserva->ubicacion_id = request()->retiro;
        $reserva->tipo_auto = 0;
        if(!request()->session()->has('reservaAut') ){
            request()->session()->push('reservaAut',$reserva);
        }
        return view('vehiculos.compra',compact('id','dias'));
    }

    public function realizarCompraVehiculo($id){
        $mensaje;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        $reserva = request()->session()->get('reservaAut')[0];
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $reserva->precio_auto;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('vehiculos.compra-hecha', compact('mensaje'));
            }
        }
        $reserva->save();
        request()->session()->forget('reservaAut');
        $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_auto_id'=>$reserva->id]);
        $mensaje = "Reserva comprada con éxito";
        $data = [];
        array_push($data,$reserva);
        Mail::send('mails.auto',['data'=>$data],function($message){
            $message->from('juaninhanjarry@gmail.com','Reserva Vehículo');
            $message->to(auth()->user()->email)->subject('compra realizada');
        });
        return view('vehiculos.compra-hecha', compact('mensaje'));
    }







    public function realizarCompraCarro(){
        $precio = 0;
        for($i = 1; $i<count(request()->session()->get('reservaVuelo')); $i++){
            $aux = request()->session()->get('reservaVuelo')[$i];
            $asiento = \App\Asiento::where('id',$aux->asiento_id)->first();
            $vuelo = \App\Vuelo::where('id',$aux->vuelo_id)->first();
            $precio = $precio + $vuelo->precio_vuelo;
        }
        for($i = 1; $i<count(request()->session()->get('reservaHabitacion')); $i++){
            $aux = request()->session()->get('reservaHabitacion')[$i];
            $precio = $precio + $aux->precio_res_hab;
        }
        
        for($i = 1; $i<count(request()->session()->get('reservaAuto')); $i++){
            $aux = request()->session()->get('reservaAuto')[$i];
            $precio = $precio + $aux->precio_auto;
        }
        for($i = 1; $i<count(request()->session()->get('reservaActividad')); $i++){
            $aux = request()->session()->get('reservaActividad')[$i];
            $precio = $precio + $aux->precio;
        }

        return view('carrito.compra',compact('precio'));
    }

    public function compraCarro($id, $precio){
        $mensaje;
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $precio;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('carrito.compra-hecha', compact('mensaje'));
            }
        }
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        for($i = 1; $i<count(request()->session()->get('reservaVuelo')); $i++){
            $data = [];
            $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora]);
            $auxRV = request()->session()->get('reservaVuelo')[$i];
            $auxP = request()->session()->get('pasajero')[$i];
            $auxP->save();
            $auxRV->pasajero_id = $auxP->id;
            $auxRV->save();
            $crv = \App\Compra_ReservaVuelo::create(['compra_id'=>$compra->id,'reserva_vuelo_id'=>$auxRV->id]);
            $crv->save();
            array_push($data,$auxRV);
            Mail::send('mails.vuelo',['data'=>$data],function($message){
                $message->from('juaninhanjarry@gmail.com','Reserva Vuelo');
                $message->to(auth()->user()->email)->subject('compra realizada');
            });

        }

        for($i = 1; $i<count(request()->session()->get('reservaHabitacion')); $i++){
            $data = [];
            $auxRH = request()->session()->get('reservaHabitacion')[$i];
            $auxRH->save();
            $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_habitacion_id'=>$auxRH->id]);
            $compra->save();
            array_push($data,$auxRH);
            Mail::send('mails.habitacion',['data'=>$data],function($message){
                $message->from('juaninhanjarry@gmail.com','Reserva Habitacion');
                $message->to(auth()->user()->email)->subject('compra realizada');
            });
        }

        for($i = 1; $i<count(request()->session()->get('reservaAuto')); $i++){
            $data = [];
            $auxRA = request()->session()->get('reservaAuto')[$i];
            $auxRA->save();
            $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_auto_id'=>$auxRA->id]);
            $compra->save();
            array_push($data,$auxRA);
            Mail::send('mails.auto',['data'=>$data],function($message){
                $message->from('juaninhanjarry@gmail.com','Reserva Auto');
                $message->to(auth()->user()->email)->subject('compra realizada');
            });
        }

        for($i = 1; $i<count(request()->session()->get('reservaActividad')); $i++){
            $data = [];
            $auxRA = request()->session()->get('reservaActividad')[$i];
            $auxRA->save();
            $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_actividad_id'=>$auxRA->id]);
            $compra->save();
            array_push($data,$auxRA);
            Mail::send('mails.actividad',['data'=>$data],function($message){
                $message->from('juaninhanjarry@gmail.com','Reserva Actividad');
                $message->to(auth()->user()->email)->subject('compra realizada');
            });
        }

        request()->session()->forget('reservaVuelo');
        request()->session()->forget('pasajero');
        request()->session()->forget('reservaHabitacion');
        request()->session()->forget('reservaAuto');
        request()->session()->forget('reservaActividad');
        request()->session()->push('reservaVuelo',NULL);
        request()->session()->push('pasajero',NULL);
        request()->session()->push('reservaHabitacion',NULL);
        request()->session()->push('reservaAuto',NULL);
        request()->session()->push('reservaActividad',NULL);
        $mensaje = "Compra realizada con éxito";
        return view('carrito.compra-hecha',compact('mensaje'));
    }


    public function comprarActividad($id,$personas){
        $mensaje;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        $actividad = \App\Actividad::find($id);
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $actividad->precio*$personas;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('carrito.compra-hecha', compact('mensaje'));
            }
        }
        $data = [];
        $reserva = new \App\reservaActividad();
        $reserva->cantidad_personas = $personas;
        $reserva->precio =  $actividad->precio*$personas;
        $reserva->actividad_id = $actividad->id;
        $reserva->fecha_reserva = $fecha;
        $reserva->save();
        $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_actividad_id'=>$reserva->id]);
        $compra->save();
        array_push($data,$reserva);
        Mail::send('mails.actividad',['data'=>$data],function($message){
            $message->from('juaninhanjarry@gmail.com','Compra actividad');
            $message->to(auth()->user()->email)->subject('compra realizada');
        });
        $mensaje = "Compra realizada con éxito";
        return view('seguro.compra-hecha',compact('mensaje'));
    }


    public function carro(){
        return view('carrito.carrito');
    }

}
