<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session; // Importa la clase Session
use App\Models\Usuarios;
use App\Models\Preguntas;
use App\Models\Preguntas_Usuarios;
use Illuminate\Support\Facades\Log;

class ForgotPasswordController extends Controller
{
    // Método para mostrar el formulario de cambio de contraseña
    public function showChangePasswordForm()
    {
        $preguntas = Preguntas::orderBy('id_pregunta', 'asc')
                    ->take(3)
                    ->select('id_pregunta', 'pregunta') // Aquí especificas las columnas que deseas seleccionar
                    ->get();

        return view('ForgotPassword', compact('preguntas'));
    }

    public function sendPasswordResetEmail(Request $request)
    {
        try {
            $correo = $request->input('correo');

            // Buscar el usuario por correo y estado activo
            $usuario = Usuarios::where('correo', $correo)
                                ->where('estado', true)
                                ->first();

            if ($usuario) {
                // Almacenar el usuario encontrado en la sesión
                Session::put('usuarioEncontrado', $usuario);

                return response()->json(['success' => true, 'message' => 'Correo válido.'], 200);
            } else {
                return response()->json(['error' => 'Correo no encontrado.'], 402);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Se produjo un error al buscar el correo.'], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            // Validar los datos recibidos
            $request->validate([
                'respuestas_texto' => 'required|array',
                'respuestas_texto.*' => 'required|string',
            ]);

            // Obtener las respuestas del formulario
            $respuestas = $request->input('respuestas_texto');

            // Verificar si hay un usuario almacenado en la sesión
            // if (!Session::has('usuarioEncontrado')) {
            //     return response()->json(['error' => 'No se encontró ningún usuario para cambiar la contraseña.'], 422);
            // }

            // Obtener el usuario de la sesión
            $usuarioEncontrado = Session::get('usuarioEncontrado');

            // Obtener las preguntas asociadas al usuario encontrado
            $preguntasUsuario = Preguntas_Usuarios::where('id_usuario', $usuarioEncontrado->id_usuario)
                                                    ->pluck('respuesta', 'id_pregunta')
                                                    ->toArray();

            // Validar las respuestas ingresadas contra las almacenadas en la base de datos
            foreach ($respuestas as $idPregunta => $respuestaTexto) {
                // Verificar si la pregunta existe en las respuestas almacenadas y si coincide con la respuesta ingresada
                if (!isset($preguntasUsuario[$idPregunta]) || $preguntasUsuario[$idPregunta] !== $respuestaTexto) {
                    return response()->json(['error' => 'Una o más respuestas no son válidas.'], 400);
                }
            }

            return response()->json(['success' => true, 'message' => '¡Respuestas validadas correctamente!'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Se produjo un error al validar las respuestas.'], 500);
        }
    }

    public function guardarNuevaContrasena(Request $request)
    {
        try {
            // Validar los datos recibidos
            $request->validate([
                'new_password' => 'required',
                'confirm_password' => 'required|same:new_password',
            ]);

            // Obtener el usuario de la sesión
            $usuarioEncontrado = Session::get('usuarioEncontrado');

            // Buscar al usuario por correo electrónico
            $user = Usuarios::where('correo', $usuarioEncontrado->correo)->first();

            // Verificar si se encontró un usuario con el correo electrónico proporcionado
            if (!$user) {
                return response()->json(['error' => 'No se encontró ningún usuario con el correo electrónico proporcionado.'], 422);
            }

            // Cambiar la contraseña del usuario
            $user->password = Hash::make($request->new_password);
            $user->save();

            // Limpiar la sesión después de utilizarla
            Session::forget('usuarioEncontrado');

            // Mostrar un mensaje de éxito y redirigir al inicio de sesión
            return response()->json(['success' => true, 'message' => '¡La contraseña se ha cambiado correctamente! Por favor, inicia sesión con tu nueva contraseña.'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Se produjo un error al cambiar la contraseña.'], 500);
        }
    }



}
