<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;
use App\Models\Rol;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // $roles = Rol::all();
        $roles = Rol::where('nombre_rol', '!=', 'ADMINISTRADOR')
        ->where('nombre_rol', '!=', 'MODERADOR')
        ->get();
        return view('register', compact('roles'));
    }

    public function verifyEmail(Request $request)
    {
        $correo = $request->input('correo');

        // Verificar si el correo ya está registrado
        $exists = Usuarios::where('correo', $correo)->exists();

        return response()->json(['exists' => $exists]);
    }

    public function store(Request $request)
    {
        // Validar datos
        // $request->validate([
        //     'nombre' => 'required',
        //     'apellido' => 'required',
        //     'edad' => 'required|numeric',
        //     'correo' => 'required|email',
        //     'password' => 'required',
        //     'id_rol' => 'required|exists:roles,id_rol',
        // ]);

        // Verificar si el correo electrónico ya está registrado
        $existingUser = Usuarios::where('correo', $request->correo)->exists();
        if ($existingUser) {
            return response()->json(['error' => 'El correo electrónico ya está registrado. Por favor, utiliza otro correo.'], 422);
        }

        // Crear el nuevo usuario
        $user = new Usuarios();
        $user->nombre = $request->nombre;
        $user->apellido = $request->apellido;
        $user->edad = $request->edad;
        $user->correo = $request->correo;
        $user->password = bcrypt($request->password);
        $user->id_rol = $request->id_rol;
        $user->estado = 1;
        $user->fechaCreacion = now();
        $user->save();

        // Enviar respuesta JSON con mensaje de éxito
        return response()->json(['success' => true, 'message' => '¡Registro exitoso!'], 200);
    }


}
