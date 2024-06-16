<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuarios;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected $usuarios;

    public function __construct(Usuarios $usuarios)
    {
        $this->usuarios=$usuarios;
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'correo' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if(Auth::attempt($credentials))
        {
            $user = Auth::user();

            $userWithRol = Usuarios::where('correo', $user->correo)->first();

            if ($userWithRol) {
                // Lógica para redireccionar según el rol del usuario
                $redirectPath = $this->getRedirectPath($userWithRol->id_rol);

                // Crear sesión
                $request->session()->put('user', $user);

                return response()->json(['success' => true, 'message' => '¡Inicio de sesión exitoso!', 'redirect' => $redirectPath, 'ver' => $userWithRol->id_rol], 200);
            } else {
                // Manejo de error si no se encuentra el usuario en la base de datos
                return response()->json(['error' => 'Error al iniciar sesión. No se pudo obtener información del usuario.'], 422);
            }
        } else {
            return response()->json(['error' => 'Credenciales incorrectas. Inténtalo de nuevo.'], 422);
        }

        // $credentials = $request->validate([
        //     'correo' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);

        // if (Auth::guard('web')->attempt($credentials)) {
        //     $user = Auth::guard('web')->user();

        //     // Consulta a la base de datos para obtener el id_rol del usuario autenticado
        //     $userWithRol = Usuarios::where('correo', $user->correo)->first();

        //     if ($userWithRol) {
        //         // Lógica para redireccionar según el rol del usuario
        //         $redirectPath = $this->getRedirectPath($userWithRol->id_rol);

        //         return response()->json(['success' => true, 'message' => '¡Inicio de sesión exitoso!', 'redirect' => $redirectPath]);
        //     } else {
        //         // Manejo de error si no se encuentra el usuario en la base de datos
        //         return response()->json(['error' => 'Error al iniciar sesión. No se pudo obtener información del usuario.'], 401);
        //     }
        // } else {
        //     return response()->json(['error' => 'Credenciales incorrectas. Inténtalo de nuevo.'], 401);
        // }
    }

    private function getRedirectPath($idRol)
    {
        // Determinar el redireccionamiento según el tipo de rol

        switch ($idRol) {
            case 1:
                return '/admin'; // Redirigir a la página de dashboard del administrador
            case 3:
                return '/turista/dashboard'; // Redirigir a la página de turista
            case 4:
                return '/emprendedor/dashboard'; // Redirigir a la página de emprendedor
            default:
                return '/error/page'; // Redirigir a una página por defecto
        }
    }

    // public function logout(Request $request)
    // {
    //     Auth::guard('web')->logout();
    //     $request->session()->invalidate();
    //     $request->session()->regenerateToken();

    //     return redirect()->route('login');
    // }

    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión del usuario
        $request->session()->invalidate(); // Invalida la sesión actual
        $request->session()->regenerateToken(); // Regenera el token de sesión

        return redirect()->route('login'); // Redirige al usuario al formulario de inicio de sesión
    }
    
}
