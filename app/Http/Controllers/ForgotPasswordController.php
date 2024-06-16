<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuarios;

class ForgotPasswordController extends Controller
{
    // Método para mostrar el formulario de cambio de contraseña
    public function showChangePasswordForm()
    {
        return view('ForgotPassword');
    }

    // Método para procesar el cambio de contraseña
    public function changePassword(Request $request)
    {
        // Validar los datos del formulario
        // $request->validate([
        //     'correo' => 'required|email',
        //     'current_password' => 'required',
        //     'new_password' => 'required|min:8',
        //     'confirm_password' => 'required|same:new_password',
        // ]);

        // Buscar al usuario por correo electrónico
        $user = Usuarios::where('correo', $request->correo)->first();

        // Verificar si se encontró un usuario con el correo electrónico proporcionado
        if (!$user) {
            return response()->json(['error' => 'No se encontró ningún usuario con el correo electrónico proporcionado.'], 422);
        }

        // Verificar si la contraseña nueva es igual a la de confirmación
        if ($request->new_password !== $request->confirm_password) {
            return response()->json(['error' => 'La contraseña de confirmación no coincide con la nueva contraseña.'], 422);
        }

        // Obtener las pistas de contraseña proporcionadas por el usuario
        $currentPasswords = explode(',', $request->current_password);
    
        // Verificar si alguna de las pistas de contraseña coincide con la contraseña almacenada
        $storedPassword = $user->password;
        $matchFound = false;
    
        foreach ($currentPasswords as $currentPassword) {
            if (strpos($storedPassword, $currentPassword) !== false) {
                // Si una de las pistas coincide con la contraseña almacenada, establecer matchFound a true
                $matchFound = true;
                break;
            }
        }
    
        if (!$matchFound) {
            // Ninguna de las pistas coincide con la contraseña almacenada
            return response()->json(['error' => 'Ninguna de las pistas de la contraseña actual coincide con la contraseña almacenada.'], 422);
        }
    
        // Cambiar la contraseña del usuario
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Mostrar un mensaje de éxito y redirigir al inicio de sesión
        return response()->json(['success' => true, 'message' => '¡La contraseña se ha cambiado correctamente! Por favor, inicia sesión con tu nueva contraseña.'], 200);
    }
}
