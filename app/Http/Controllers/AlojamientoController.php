<?php

namespace App\Http\Controllers;

use Validator;
use App\Alojamiento;
use Illuminate\Http\Request;
use DateTime;

class AlojamientoController extends Controller
{

    public function rules(){
        return[
        'ciudad_id' =>  'required|string',
        'nombre_alojamiento' => 'required|string',
        'numero_estrellas' => 'required|numeric',
        'calle_alojamiento' => 'required|string',
        'numero_alojamiento' => 'required|numeric',
        ];
    }

    public function rules2(){
        return[
        'ciudad_id' =>  'nullable|string',
        'nombre_alojamiento' => 'nullable|string',
        'numero_estrellas' => 'nullable|numeric',
        'calle_alojamiento' => 'nullable|string',
        'numero_alojamiento' => 'nullable|numeric',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $alojamientos = Alojamiento::all();

        return view('alojamientos.alojamientoAll',compact('alojamientos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agregar-alojamiento');
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
        $alojamiento = Alojamiento::create($request->all());      
        $alojamiento->save();
        return $alojamiento;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $alojamiento = Alojamiento::find($id);
        return $alojamiento;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function edit(Alojamiento $alojamiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $alojamiento = Alojamiento::where('id', '=', $id)->first();
        $alojamiento->update($request->all());
        return $alojamiento;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Alojamiento  $alojamiento
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $alojamiento = Alojamiento::find($id);
        $alojamiento->delete();
        return "";
    }

    public function habitaciones($id)
    {
        $habitaciones = Alojamiento::with('habitacion')->find($id);
        return $habitaciones;
    }

    public function alojamientoPais(){
        //return request()->all();
        $start = new DateTime(request()->start);
        $start = Date($start->format('Y-m-d'));
        $end = new DateTime(request()->return);
        $end = Date($end->format('Y-m-d'));
        if($start>$end){
            return redirect('/');
        }
        $alojamientos = Alojamiento::where('ciudad_id',request()->ciudad)->get();
        if(request()->session()->has('start')){
            request()->session()->forget('start');
            request()->session()->forget('return');
        }
        request()->session()->push('start',request()->start);
        request()->session()->push('return',request()->return);
        return view('alojamientos.alojamientos',compact('alojamientos'));
    }

    public function agregarAlojamiento(){
        $alojamiento = new Alojamiento();
        $disponibilidad = request()->disponibilidad;
        $usuario = auth()->user();
        $auditoria = new \App\Auditoria();
        $fecha = date('Y-m-d');
        $hora = date("H:i:s");

        $alojamiento->ciudad_id = request()->ciudadHotel;
        $alojamiento->nombre_alojamiento = request()->nombre;
        $alojamiento->numero_estrellas = request()->numeroEstrellas;
        $alojamiento->calle_alojamiento = request()->calle;
        $alojamiento->numero_alojamiento = request()->numeroCalle;
        if ($disponibilidad == '1'){
            $alojamiento->disponibilidad = true;
        }
        else{

            $alojamiento->disponibilidad = false;
        }
        $auditoria->descripcion = "Se agregó el alojamiento  " .$alojamiento->nombre_alojamiento." " . $fecha . "\r\n";
        $auditoria->user_id = $usuario->id;
        $auditoria->tipo_auditoria = 1;
        $auditoria->fecha_auditoria = $fecha;
        $auditoria->hora_auditoria = $hora;
        $alojamiento->save();
        $auditoria->save();
        $alojamientos = Alojamiento::all();

        return view('alojamientos.alojamientoAll', compact('alojamientos'));
    }

    public function eliminarCarro($index){
        $aux = request()->session()->get('reservaHabitacion');
        unset($aux[$index]);
        array_values($aux);
        request()->session()->forget('reservaHabitacion');
        foreach($aux as $a){
            request()->session()->push('reservaHabitacion',$a);
        }
        return redirect('/carro');
    }
}
