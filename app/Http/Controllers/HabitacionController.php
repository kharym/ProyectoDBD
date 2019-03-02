<?php

namespace App\Http\Controllers;

use Validator;
use App\Habitacion;
use Illuminate\Http\Request;

class HabitacionController extends Controller
{

    public function rules(){
        return[
        'reserva_habitacion_id' =>  'required|numeric',
        'alojamiento_id' =>  'required|numeric',
        'numero_habitacion' => 'required|numeric',
        'tipo_habitacion' => 'required|numeric',
        'numero_camas' =>  'required|numeric',
        'numero_banos' => 'required|numeric',
        'disponibilidad' => 'required|boolean',
        ];
    }

    public function rules2(){
        return[
        'reserva_habitacion_id' =>  'nullable|numeric',
        'alojamiento_id' =>  'nullable|numeric',
        'numero_habitacion' => 'nullable|numeric',
        'tipo_habitacion' => 'nullable|numeric',
        'numero_camas' =>  'nullable|numeric',
        'numero_banos' => 'nullable|numeric',
        'disponibilidad' => 'nullable|boolean',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //devuelve todo
    public function index()
    {
        $habitacion = Habitacion::all();
        return $habitacion;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agregar-habitacion');
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
        $hab = Habitacion::create($request->all());      
        $hab->save();
        return $hab;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $habitacion = Habitacion::find($id);
        return view('alojamientos.habitacion',compact('habitacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Habitacion $habitacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $hab = Habitacion::where('id', '=', $id)->first();
        $hab->update($request->all());
        return $hab;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Habitacion  $habitacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $habitacion = Habitacion::find($id);
        $habitacion->delete();
        return "";
    }

    public function habitaciones($id){
        $habitaciones = Habitacion::where("alojamiento_id",$id)->get();

        return view('alojamientos.habitacion',compact('habitaciones'));
    }

    public function habitacionReserva($habitacion){
        
        return view('alojamientos.reservaHabitacion', compact('habitacion'));
    }

    public function reservarHabitacion($id){
        
        return view('alojamientos.reservaHabitacion');
    }

    public function agregarHabitacion(){
        $habitacion = new Habitacion();
        $disponibilidad = request()->disponibilidad;

        $habitacion->alojamiento_id = request()->alojamiento;
        $habitacion->numero_habitacion = request()->numeroHabitacion;
        $habitacion->tipo_habitacion = request()->tipoHabitacion;
        $habitacion->numero_camas = request()->numeroCamas;
        $habitacion->numero_banos = request()->numeroBanos;
        $habitacion->capacidad_ninos = request()->capacidadNinos;
        $habitacion->capacidad_adultos = request()->capacidadAdultos;
        $habitacion->precio = request()->precio;
        if ($disponibilidad == '1'){
            $habitacion->disponibilidad = true;
        }
        else{

            $habitacion->disponibilidad = false;
        }
        $habitacion->save();
        $alojamientos = \App\Alojamiento::all(); 

        return view('alojamientos.alojamientoAll', compact('alojamientos'));
    }

}
