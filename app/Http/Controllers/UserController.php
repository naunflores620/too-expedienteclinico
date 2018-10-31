<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::join('persona', 'users.id', '=', 'persona.id')
            ->join('roles', 'users.rol_id','=', 'roles.id')
            ->join('direcciones', 'persona.direccion_id', '=', 'direcciones.id')
            ->join('municipios', 'direcciones.municipio_id', '=', 'municipios.id')
            ->join('departamentos', 'municipios.departamento_id', '=', 'departamentos.id')
            ->select('users.id', 'persona.nombre','persona.apellidos' ,'persona.documentoDeIdentidad', 'direcciones.casa', 'direcciones.calle', 'municipios.municipio', 'departamentos.departamento', 'persona.fechaDeNacimiento', 'persona.estadoCivil', 'persona.genero', 'persona.clinica_id', 'users.usuario', 'users.password', 'roles.nombre as rol')
            ->orderBy('users.id', 'desc')
            ->get();
        return $users;
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
        try{
            DB::beginTransaction();
            $persona = App\Persona::findOrFail($request->persona_id);
            $rol = App\Rol::findOrFail($request->rol_id);

            $user = new User();
            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password);
            $user->rol()->associate($rol);
            $user->persona()->associate($persona);

            $user->save();
            
            DB::commit();

            return $user;
        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            DB::beginTransaction();
            $persona = App\Persona::findOrFail($request->persona_id);
            $rol = App\Rol::findOrFail($request->rol_id);

            $user = User::findOrFail($request->id);
            $user->usuario = $request->usuario;
            $user->password = bcrypt($request->password);
            $user->rol()->associate($rol);
            $user->persona()->associate($persona);

            $user->save();
            
            DB::commit();
            
            return $user;
        }catch(Exception $e){
            DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        User::destroy($request->id);
    }
}
