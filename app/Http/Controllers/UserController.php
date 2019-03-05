<?php

namespace App\Http\Controllers;

use Validator;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function rules(){
        return[
        'rol_id' =>  'required|numeric',
        'auditoria_id' => 'required|numeric',
        'name' => 'required|string',
        'apellido' => 'required|string',
        'email' =>  'required|email',
        'tipo_documento' => 'required|numeric',
        'numero_documento' => 'required|numeric',
        'pais' => 'required|string',
        'fecha_nacimiento' =>  'required|date',
        'telefono' => 'required|string',
        'password' => 'required|string',
        ];
    }

    public function rules2(){
        return[
        'rol_id' =>  'nullable|numeric',
        'auditoria_id' => 'nullable|numeric',
        'name' => 'nullable|string',
        'apellido' => 'nullable|string',
        'email' =>  'nullable|email',
        'tipo_documento' => 'nullable|numeric',
        'numero_documento' => 'nullable|numeric',
        'pais' => 'nullable|string',
        'fecha_nacimiento' =>  'nullable|date',
        'telefono' => 'nullable|string',
        'password' => 'nullable|string',
        ];
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuario = User::all();
        return $usuario;
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
        $usuario = User::create($request->all());      
        $usuario->save();
        return $usuario;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $usuario = User::find($id);
        return $usuario;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(User $ubicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validador = Validator::make($request->all(),$this->rules2());
        if($validador->fails()){
            return $validador->messages();
        }
        $user = User::where('id', '=', $id)->first();
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ubicacion  $ubicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $usuario = User::find($id);
        $usuaio->delete();
        return "";
    }

    public function movimientos($id){
        $compras = \App\Compra::where('user_id',$id)->get();
        return view('user.movimientos',compact('compras'));
    }

    public function mostrarAuditoria($id){
        $user = User::find($id);
        $id_auditoria = $user->auditoria_id;

        $auditoria = \App\Auditoria::find($id_auditoria);




        return view ('admin.auditoria', compact('auditoria'));
    }
}
