<?php

namespace App\Http\Controllers;

use Validator;
use App\Empresa;
use Illuminate\Http\Request;

class EmpresaController extends Controller
{

    public function rules(){
        return[
        'ciudad_id' =>  'required|numeric',
        'nombre_empresa' =>  'required|string',
        'telefono_empresa' => 'required|numeric',
        'correo_empresa' => 'required|email',
        ];
    }
    
    public function rules2(){
        return[
        'ciudad_id' =>  'nullable|numeric',
        'nombre_empresa' =>  'nullable|string',
        'telefono_empresa' => 'nullable|numeric',
        'correo_empresa' => 'nullable|email',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empresa = Empresa::all();
        return $empresa;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.agregar-empresa');
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
        $empresa = Empresa::create($request->all());      
        $empresa->save();
        return $empresa;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $empresa = Empresa::find($id);
        return $empresa;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function edit(Empresa $empresa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $empresa = Empresa::where('id', '=', $id)->first();
        $empresa->update($request->all());
        return $empresa;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empresa  $empresa
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $empresa = Empresa::find($id);
        $empresa->delete();
        return "";
    }

    public function agregarEmpresa(){

        $empresa = new Empresa();
        $usuario = auth()->user();
        $auditoria = \App\Auditoria::find($usuario->auditoria_id);
        $fecha = date('Y-m-d H:i:s');

        $empresa->ubicacion_id = request()->ubicacion;
        $empresa->nombre_empresa = request()->nombreEmpresa;
        $empresa->telefono_empresa = request()->telefonoEmpresa;
        $empresa->correo_empresa = request()->correoEmpresa;
        $empresa->save();
        $auditoria->descripcion = $auditoria->descripcion."Se agregó la empresa ".$empresa->nombre_empresa." " . $fecha . "\r\n";
        $auditoria->save();

        return view('index');

    }
}
