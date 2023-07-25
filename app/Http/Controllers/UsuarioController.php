<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;
use App\Models\Programacion;
use App\Http\Resources\ProgramacionResource;
use App\Http\Resources\ProgramacionCollection;

class UsuarioController extends Controller
{
    public function login(Request $request)
    {
        $correo = $request->input('correo');
        $contrasena = $request->input('contrasena');

        $persona = Persona::where('email','=',$correo)->where('password','=',$contrasena)->first();

        if($persona){
            return response()->json($persona);
        }
        return response()->json(0, 203);
    }

    public function programacionestecnico(Request $request)
    {
        $id = $request->input('id');
        $programaciones = Programacion::where('id_tecnico', '=', $id)->where('estado','=','asignado')->get();
        return response()->json(new ProgramacionCollection($programaciones));
        //return response()->json($programaciones);
    }

    public function iniciarProgramacion(Request $request)
    {
        $latitud = $request->input('latitud');
        $longitud = $request->input('longitud');
        $estado = $request->input('estado');
        $programacionId = $request->input('programacionId');

        $programacion = Programacion::findOrFail($programacionId);
        $programacion->latitud = $latitud;
        $programacion->longitud = $longitud;
        $programacion->estado = $estado;

        $programacion->save();

        return response()->json( new ProgramacionResource($programacion),203);
    }

    public function finalizarProgramacion(Request $request)
    {
        $estado = $request->input('estado');
        $programacionId = $request->input('programacionId');

        $programacion = Programacion::findOrFail($programacionId);
        $programacion->estado = $estado;

        $programacion->save();

        return response()->json( new ProgramacionResource($programacion),203);
    }
}
