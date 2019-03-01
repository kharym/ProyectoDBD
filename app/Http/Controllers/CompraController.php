<?php

namespace App\Http\Controllers;

use Validator;
use App\Compra;
use Illuminate\Http\Request;
use DateTime;

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
        return view('compra',compact('id'));
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
        $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_habitacion_id'=>$reserva->id]);
        $mensaje = "Reserva comprada con éxito";
        return view('alojamientos.compra-hecha', compact('mensaje'));
    }

    public function comprarVehiculo($id){
        $inicio = new DateTime(request()->start);
        $fin = new DateTime(request()->return);
        $dias = $fin->diff($inicio)->format("%a");
        
        $auto = \App\Auto::find($id);

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
            $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora]);
            $auxRV = request()->session()->get('reservaVuelo')[$i];
            $auxP = request()->session()->get('pasajero')[$i];
            $auxP->save();
            $auxRV->pasajero_id = $auxP->id;
            $auxRV->save();
            $crv = \App\Compra_ReservaVuelo::create(['compra_id'=>$compra->id,'reserva_vuelo_id'=>$auxRV->id]);
            $crv->save();
        }

        for($i = 1; $i<count(request()->session()->get('reservaHabitacion')); $i++){
            $auxRH = request()->session()->get('reservaHabitacion')[$i];
            $auxRH->save();
            $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_habitacion_id'=>$auxRH->id]);
            $compra->save();
        }

        for($i = 1; $i<count(request()->session()->get('reservaAuto')); $i++){
            $auxRA = request()->session()->get('reservaAuto')[$i];
            $auxRA->save();
            $compra = Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'reserva_auto_id'=>$auxRA->id]);
            $compra->save();
        }

        request()->session()->forget('reservaVuelo');
        request()->session()->forget('pasajero');
        request()->session()->forget('reservaHabitacion');
        request()->session()->forget('reservaAuto');
        request()->session()->push('reservaVuelo',NULL);
        request()->session()->push('pasajero',NULL);
        request()->session()->push('reservaHabitacion',NULL);
        request()->session()->push('reservaAuto',NULL);
        $mensaje = "Compra realizada con éxito";
        return view('carrito.compra-hecha',compact('mensaje'));
    }

}
