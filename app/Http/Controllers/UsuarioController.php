<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Usuarios;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UsuarioController extends Controller
{
    protected $usuarios;

    public function __construct(Usuarios $usuarios)
    {
        $this->usuarios=$usuarios;
    }
    
     public function index()
    {
        $rol = Rol::where('estado', true)->get();
        $usuarios = Usuarios::where('estado', true)->get();

        return view('/admin/usuarios', compact('usuarios', 'rol'));
    }

    public function getTablaUsuarios()
    {
            $lstUsuarios = Usuarios::select([
                'usuarios.id_usuario as id_usuario',
                'usuarios.id_rol as id_rol',
                'usuarios.nombre as nombre',
                'usuarios.apellido as apellido',
                'usuarios.edad as edad',
                'usuarios.correo as correo',
                'usuarios.password as password',
                'usuarios.estado as estado',
                'usuarios.imagen as imagen',
                'usuarios.fechaCreacion as fechaCreacion',
                'rol.nombre_rol as nombre_rol'
            ])
            ->join('rol', 'usuarios.id_rol', '=', 'rol.id_rol')
            ->where('usuarios.estado', true)
            ->where('rol.estado', true)
            ->get();
    

            return response()->json($lstUsuarios);
        
    }
    
     public function indexResetPassword()
    {
        return view('/admin/changePass');
    }

    public function getCorreo(Request $request)
    {
        $correo = $request->input('correo');
        $valor = Usuarios::where('correo', $correo)
        ->where('estado',true)
        ->select('estado')
        ->get();

        return response()->json($valor);
    }

    public function update(Request $request)
    {
        $usuarios = Usuarios::find($request->id_usuario);
        $usuarios->id_rol = $request->input('id_rol');
        $usuarios->nombre = $request->input('nombre');
        $usuarios->apellido = $request->input('apellido');
        $usuarios->edad = $request->input('edad');
    
        if ($usuarios->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }

    public function updateImage(Request $request)
    {
        $usuarios = Usuarios::find($request->input('IdUsuario2'));
        $usuarios->id_rol = $request->IdRol2;
        $usuarios->nombre = $request->Nombre2;
        $usuarios->apellido = $request->Apellido2;
        $usuarios->edad = $request->Edad2;

        if ($request->hasFile('Imagen2')) {
            $imageFile = $request->file('Imagen2');
            $imageContents = base64_encode(file_get_contents($imageFile->getRealPath()));
            $usuarios->imagen = $imageContents;
        }

        if ($usuarios->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }

    }

    public function save(Request $request)
    {

        $usuarios = new Usuarios();
        $usuarios->id_rol = $request->IdRol;
        $usuarios->nombre = $request->Nombre;
        $usuarios->apellido = $request->Apellido;
        $usuarios->edad = $request->Edad;
        $usuarios->correo = $request->Correo;

        // $sha256_hash = hash('sha256', $request->Password);  
        // $usuarios->password = $sha256_hash;
        $usuarios->password = bcrypt($request->Password);
        $usuarios->estado = true;
        $usuarios->fechaCreacion = Carbon::now();    

        if ($request->hasFile('Imagen')) {
            $imageFile = $request->file('Imagen');
            $imageContents = base64_encode(file_get_contents($imageFile->getRealPath()));
            $usuarios->imagen = $imageContents;
        }

        if ($usuarios->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $correo = $request->input('correo');
            $valor = $request->input('valor');
    
            $objUpt = Usuarios::where('correo', $correo)->first();
        
            // $sha256_hash = hash('sha256', $valor); 
            // $objUpt->password = $sha256_hash; 
            $objUpt->password = bcrypt($valor);

            if($objUpt->save()){
                return response()->json(true);
            }else{
                return response()->json(false);
            }

        } catch (Exception $ex) {
            return response()->json(false);
        }
    }


    public function destroy(Request $request)
    {
        $usuarios = Usuarios::find($request->input('id_usuario'));
        $usuarios->estado = false;

        if ($usuarios->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    
}
