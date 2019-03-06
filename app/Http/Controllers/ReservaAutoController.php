<?php

namespace App\Http\Controllers;

use Validator;
use App\ReservaAuto;
use Illuminate\Http\Request;
use DateTime;

class ReservaAutoController extends Controller
{

    public function rules(){
        return[
        'auto_id' =>  'required|numeric',
        'precio_auto' => 'required|numeric',
        'fecha_recogido' => 'required|date',
        'fecha_devolucion' => 'required|date',
        'hora_recogido' => 'required|string',
        'hora_devolucion' => 'required|string',
        'tipo_auto' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'auto_id' =>  'nullable|numeric',
        'precio_auto' => 'nullable|numeric',
        'fecha_recogido' => 'nullable|date',
        'fecha_devolucion' => 'nullable|date',
        'hora_recogido' => 'nullable|string',
        'hora_devolucion' => 'nullable|string',
        'tipo_auto' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaAuto = ReservaAuto::all();
        return $reservaAuto;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
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
        $ra = ReservaAuto::create($request->all());      
        $ra->save();
        return $ra;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $reservaAuto = ReservaAuto::find($id);
        return $reservaAuto;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function edit(ReservaAuto $reservaAuto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $rA = ReservaAuto::where('id', '=', $id)->first();
        $rA->update($request->all());
        return $rA;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ReservaAuto  $reservaAuto
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $reservaAuto = ReservaAuto::find($id);
        $reservaAuto->delete();
        return "";
    }

    public function carritoCompraAuto($id){
        $inicio = new DateTime(request()->start);
        $fin = new DateTime(request()->end);
        $dias = $fin->diff($inicio)->format("%a");


        if($inicio>$fin){
            return redirect('/');
        }

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
        
        $reserva = new \App\ReservaAuto();
        $reserva->auto_id = $id;
        $reserva->precio_auto = $auto->precio*$dias;
        $reserva->fecha_recogido = $inicio;
        $reserva->fecha_devolucion = $fin;
        $reserva->ubicacion_id = request()->retiro;
        $reserva->tipo_auto = 0;

        foreach(request()->session()->get('reservaAuto') as $rv){
            if(!is_null($rv)){
                if($reserva->auto_id == $rv->auto_id){
                    return view('carrito.carrito');
                }
            }
        }
        request()->session()->push('reservaAuto',$reserva);     
        return view('carrito.carrito');
    }
}
