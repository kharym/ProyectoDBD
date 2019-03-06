<?php

namespace App\Http\Controllers;

use Validator;
use App\Seguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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
        $inicio = new DateTime(request()->fechaIda);
        $fin = new DateTime(request()->fechaVuelta);
        if($inicio>$fin){
            return redirect('/');
        }
        $seguro = new \App\Seguro();
        $seguro->edad_pasajero = request()->edad;
        $seguro->dni = request()->dni;
        $precio = request()->precio*0.1;
        if(request()->dental){
            $seguro->seguro_dental = true;
            $precio = $precio*0.05;
        }
        else{
            $seguro->seguro_dental = false;
        }

        if(request()->accidente){
            $seguro->seguro_accidentes = true;
            $precio = $precio*0.05;
        }
        else{
            $seguro->seguro_accidentes = false;
        }

        if(request()->equipaje){
            $seguro->perdida_equipaje = true;
            $precio = $precio*0.05;
        }
        else{
            $seguro->perdida_equipaje = false;
        }

        if(request()->legal){
            $seguro->asesoria_legal = true;
            $precio = $precio*0.05;
        }
        else{
            $seguro->legal = false;
        }

        if(request()->siniestro){
            $seguro->seguro_siniestros = true;
            $precio = $precio*0.05;
        }
        else{
            $seguro->seguro_siniestros = false;
        }

        if(request()->vuelo){
            $seguro->problemas_viaje = true;
            $precio = $precio*0.05;
        }

        else{
            $seguro->problemas_viaje = false;
        
        }
        $seguro->ida_vuelta = false;
        $seguro->cantidad_personas = 1;
        $seguro->costo_pasaje = $precio;

        $seguro->fecha_ida = request()->fechaIda;
        $seguro->fecha_vuelta = request()->fechaVuelta;
        $seguro->destino = "a";
        if(request()->session()->has('rS')){
            request()->session()->forget('rS');
            return redirect('/reservar-seguro');
        }
        request()->session()->push('rS',$seguro);
        return view('seguro.compra-seguro');
    }

    public function compraSeguroHecha($id){
        $mensaje;
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");
        if(!request()->session()->has('rS')){
            return redirect('/reservar-seguro');
        }
        $seguro = request()->session()->get('rS')[0];
        if(request()->medioPago == "1"){
            if(\App\MedioDePago::where('id',request()->numeroCuenta)->exists()){
               $mp = \App\MedioDePago::where('id',request()->numeroCuenta)->first();
               $mp->monto = $mp->monto - $seguro->costo_pasaje;
               $mp->save();
            }
            else{
                $mensaje = "No existe el medio de pago";
                return view('seguro.compra-hecha', compact('mensaje'));
            }
        }
        $seguro->save();
        request()->session()->forget('rS');
        $compra = \App\Compra::create(['user_id'=>$id,'fecha_compra'=>$fecha, 'hora_compra'=>$hora, 'seguro_id'=>$seguro->id]);
        $mensaje = "Reserva comprada con éxito";
        $data = [];
        array_push($data,$seguro);
        Mail::send('mails.auto',$data,function($message){
            $message->from('juaninhanjarry@gmail.com','Reserva Seguro');
            $message->to(auth()->user()->email)->subject('compra realizada');
        });
        return view('seguro.compra-hecha',compact('mensaje'));
    }
}
