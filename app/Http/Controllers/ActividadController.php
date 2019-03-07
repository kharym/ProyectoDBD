<?php

namespace App\Http\Controllers;

use Validator;
use App\Actividad;
use Illuminate\Http\Request;

class ActividadController extends Controller
{

    public function rules(){
        return[
        'destino' =>  'required|string',
        'nombre_actividad' => 'required|string',
        'precio' => 'required|numeric',
        'cantidad_adulto' => 'required|numeric',
        'cantidad_ninos' => 'required|numeric',
        'fecha_ida' => 'required|date',
        'fecha_vuelta' => 'required|date',
        ];
    }

    public function rules2(){
        return[
        'destino' =>  'nullable|string',
        'nombre_actividad' => 'nullable|string',
        'precio' => 'nullable|numeric',
        'cantidad_adulto' => 'nullable|numeric',
        'cantidad_ninos' => 'nullable|numeric',
        'fecha_ida' => 'nullable|date',
        'fecha_vuelta' => 'nullable|date',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $actividades = Actividad::all();
        
        return view('actividades.actividadAll',compact('actividades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agregar-actividad');
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
        $actividad = Actividad::create($request->all());      
        $actividad->save();
        return $actividad;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $actividad = Actividad::find($id);
        return $actividad;    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $actividad = Actividad::where('id', '=', $id)->first();
        $actividad->update($request->all());
        return $actividad;
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Actividad  $actividad
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $actividad = Actividad::find($id);
        $actividad->delete();
        return "";
    }

    public function vistaReserva($actividad){
        return view('actividades.actividad-reserva', compact('actividad'));
    }

    public function agregarActividad(){
        $actividad = new Actividad();
        $usuario = auth()->user();
        $auditoria = new \App\Auditoria();
        $fecha = date('Y-m-d H:i:s');
        $actividad->ciudad_id = request()->destino;
        $auditoria->user_id = $usuario->id;
        $actividad->nombre_actividad = request()->nombreActividad;
        $actividad->precio = request()->precio;
        $auditoria->tipo_auditoria = 1;

        $auditoria->descripcion = "Se agregó la actividad con descripción:" .$actividad->nombre_actividad."\r\n Fecha:" . $fecha . "\r\n";

        $actividad->save();
        $auditoria->save();

        $actividades = Actividad::all();

        return view('actividades.actividadAll', compact('actividades'));
    }

    public function actividades(){
        $actividades = Actividad::all();
        return view('actividades.actividadAll',compact('actividades'));
    }

    public function seleccionar($id){
        return view('actividades.reserva',compact('id'));
    }

    public function eliminarCarro($index){
        $aux = request()->session()->get('reservaActividad');
        unset($aux[$index]);
        array_values($aux);
        request()->session()->forget('reservaActividad');
        foreach($aux as $a){
            request()->session()->push('reservaActividad',$a);
        }
        return redirect('/carro');
    }
    
    public function actividadCiudad(){
        $actividades = \App\Actividad::where('ciudad_id',request()->ciudad);
        return view('actividades.actividadAll',compact('actividades'));
    }
}
