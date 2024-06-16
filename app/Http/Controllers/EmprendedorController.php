<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugares;
use App\Models\Usuarios;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Categorias;
use App\Models\Comentarios;
use App\Models\Valoraciones;
use App\Models\Lugares_Valoraciones;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Preguntas_Usuarios;
use App\Models\Preguntas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class EmprendedorController extends Controller
{
    
    protected $lugares;

    public function __construct(Lugares $lugares)
    {
        $this->lugares=$lugares;
    }

    public function updateImageProfile(Request $request)
    {
        $user = Usuarios::find($request->input('id_usuario'));

        if ($request->hasFile('imagenArchivo')) {
            $imageFile = $request->file('imagenArchivo');
            $imageContents = base64_encode(file_get_contents($imageFile->getRealPath()));
            $user->imagen = $imageContents;
        }

        if ($user->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function getImage(Request $request)
    {
        $user = Usuarios::where('id_usuario',$request->id_usuario)->get();
        return response()->json($user);
    }

    public function showValoracionesLugar(Request $lugar)
    {
        $valoracionLugar = Lugares_Valoraciones::where('id_lugar', $lugar->IdLugar)->average('id_valoracion');
        $valoracionFormateada = number_format($valoracionLugar, 1);
        return response()->json($valoracionFormateada);
    }

    public function getAllValoracionByLugar(Request $lugar)
    {
        $valoraciones = Lugares_Valoraciones::join('usuarios', 'lugares_valoraciones.id_usuario', '=', 'usuarios.id_usuario')
            ->where('lugares_valoraciones.id_lugar', $lugar->IdLugar)
            ->orderByDesc('lugares_valoraciones.fecha')
            ->select('lugares_valoraciones.fecha', 
            'usuarios.imagen', 
            'usuarios.nombre', 
            'usuarios.apellido', 
            'lugares_valoraciones.descripcion', 
            'usuarios.id_usuario', 
            'lugares_valoraciones.id_valoracion', 
            'lugares_valoraciones.id_lvaloracion as idComentario')
            ->get();

        // Retornar las valoraciones como JSON
        return response()->json($valoraciones);
    }
    
    public function showPreguntas(){
        $user = Auth::user();

        // Consultar si el usuario ha respondido las preguntas
        $preguntasUsuario = Preguntas_Usuarios::where('id_usuario', $user->id_usuario)->first();

        // Variable para indicar si el usuario debe responder las preguntas
        $debeResponderPreguntas = $preguntasUsuario === null;

        $preguntas = Preguntas::orderBy('id_pregunta', 'desc')
                    ->take(3)
                    ->select('id_pregunta', 'pregunta') // Aquí especificas las columnas que deseas seleccionar
                    ->get();

        $departamentos = Departamento::where('estado', true)->get();
        $municipios = Municipio::where('estado', true)->get();
        $categorias = Categorias::where('estado', true)->get();

        // Log::info('Debe responder preguntas? ' . $preguntas);

        return view('/emprendedor/dashboard', compact('preguntas','debeResponderPreguntas','departamentos', 'municipios', 'categorias'));
    }

    public function guardarRespuestas(Request $request)
    {
        try {
            $user = Auth::user();
            
            // Validar los datos recibidos (si es necesario)
            $request->validate([
                'respuestas_texto' => 'required|array',
                'respuestas_texto.*' => 'required|string',
            ]);

            $respuestas = $request->input('respuestas_texto');

            foreach ($respuestas as $idPregunta => $respuestaTexto) {
                // Guardar cada respuesta en la tabla intermedia
                $guardar = new Preguntas_Usuarios();
                $guardar->id_usuario = $user->id_usuario;
                $guardar->id_pregunta = $idPregunta;
                $guardar->respuesta = $respuestaTexto;
                $guardar->save();
            }

            return response()->json(['success' => true, 'message' => '¡Respuestas guardadas correctamente!'], 200);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Se produjo un error al guardar las respuestas.'], 500);
        }
    }

    public function index()
    {
        //$usuarios = Usuarios::where('estado', true)->get();
        $departamentos = Departamento::where('estado', true)->get();
        $municipios = Municipio::where('estado', true)->get();
        $categorias = Categorias::where('estado', true)->get();

        return view('/emprendedor/dashboard', compact('departamentos', 'municipios', 'categorias'));
    }

    public function getAll()
    {
        //$usuarios = Usuarios::where('estado', true)->get();
        $departamentos = Departamento::where('estado', true)->get();
        $municipios = Municipio::where('estado', true)->get();
        $categorias = Categorias::where('estado', true)->get();

        return view('/emprendedor/getAll', compact('departamentos', 'municipios', 'categorias'));
    }


    public function postDetails($id)
    {        
        $lugar = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
            'lugares.id_municipio as idMunicipio',
            'municipio.id_depto as idDepto',
            'lugares.id_categoria as idCategoria',
            DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellido) as user'),
            'usuarios.imagen as imagenUser',
            'categorias.nombre_categoria as categoria',
            'lugares.nombre_lugar as nombre',
            'lugares.descripcion as descripcion',
            'municipio.municipio as municipio',
            'departamento.departamento as departamento',
            DB::raw('CONCAT("$", ROUND(lugares.precio, 2)) as precio'),
            DB::raw('ROUND(lugares.precio, 2) as precio2'),
            'lugares.imagen as imagen',
            'lugares.fechaPublicacion as fecha'
        ])
        ->join('usuarios', 'lugares.id_usuario', '=', 'usuarios.id_usuario')
        ->join('categorias', 'lugares.id_categoria', '=', 'categorias.id_categoria')
        ->join('municipio', 'lugares.id_municipio', '=', 'municipio.id_municipio')
        ->join('departamento', 'municipio.id_depto', '=', 'departamento.id_depto')
        ->where('usuarios.estado', true)
        ->where('categorias.estado', true)
        ->where('municipio.estado', true)
        ->where('lugares.estado', true)
        ->where('lugares.id_lugar', $id)
        ->get();

        if ($lugar->count() > 0) {
            return view('emprendedor.postDetails', compact('lugar'));
        }else {
            
            abort(404);
        }

        
    }

    public function allCommentsByLugar(Request $request)
    {
        $comments = Comentarios::join('usuarios', 'comentarios.id_usuario', '=', 'usuarios.id_usuario')
                    ->where('comentarios.id_lugar',$request->id)
                    ->where('comentarios.estado', true)
                    ->orderByDesc('comentarios.fecha')
                    ->select('comentarios.fecha as fecha',
                             'usuarios.imagen as imagen',
                             'usuarios.nombre as nombre',
                             'usuarios.apellido as apellido',
                             'comentarios.comentario as comentario',
                             'usuarios.id_usuario as idUsuario',
                             'comentarios.id_comentario as idComentario')
                    ->get();

        return response()->json($comments);
    }

    public function setProfileUserId(Request $request)
    {
        $userId = $request->input('userId');
        Session::put('profileUserId', $userId);
        return response()->json(['success' => true]);
    }

    public function profile()
    {
        $userId = Session::get('profileUserId');

        $usuarios = Usuarios::select([
            'usuarios.imagen',
            'usuarios.id_usuario',
            'usuarios.nombre',
            'usuarios.apellido',
            'usuarios.edad',
            'usuarios.correo'])
                            ->where('id_usuario', $userId)
                            ->where('estado', true)
                            ->first();

        if (!$usuarios) {
            abort(404);
        }

        return view('/emprendedor/profile', compact('usuarios'));
    }

    public function getTablaLugaresByUserId(Request $user)
    {
            $lstLugares = Lugares::select([
                'lugares.id_lugar as idLugar',
                'usuarios.id_usuario as idUser',
                'usuarios.imagen as imagenUser',
                'lugares.id_municipio as idMunicipio',
                'municipio.id_depto as idDepto',
                'lugares.id_categoria as idCategoria',
                DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellido) as user'),
                'categorias.nombre_categoria as categoria',
                'lugares.nombre_lugar as nombre',
                'lugares.descripcion as descripcion',
                'municipio.municipio as municipio',
                'departamento.departamento as departamento',
                DB::raw('CONCAT("$", ROUND(lugares.precio, 2)) as precio'),
                DB::raw('ROUND(lugares.precio, 2) as precio2'),
                'lugares.imagen as imagen',
                'lugares.imagen as imagen',
                'lugares.fechaPublicacion as fecha'
            ])
            ->join('usuarios', 'lugares.id_usuario', '=', 'usuarios.id_usuario')
            ->join('categorias', 'lugares.id_categoria', '=', 'categorias.id_categoria')
            ->join('municipio', 'lugares.id_municipio', '=', 'municipio.id_municipio')
            ->join('departamento', 'municipio.id_depto', '=', 'departamento.id_depto')
            ->where('usuarios.estado', true)
            ->where('categorias.estado', true)
            ->where('municipio.estado', true)
            ->where('lugares.estado', true)
            ->where('usuarios.id_usuario', $user->id_usuario)
            ->get();

            return response()->json($lstLugares);  
    }

    public function getTablaLugares()
    {
            $lstLugares = Lugares::select([
                'lugares.id_lugar as idLugar',
                'usuarios.id_usuario as idUser',
                'usuarios.imagen as imagenUser',
                'lugares.id_municipio as idMunicipio',
                'municipio.id_depto as idDepto',
                'lugares.id_categoria as idCategoria',
                DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellido) as user'),
                'categorias.nombre_categoria as categoria',
                'lugares.nombre_lugar as nombre',
                'lugares.descripcion as descripcion',
                'municipio.municipio as municipio',
                'departamento.departamento as departamento',
                DB::raw('CONCAT("$", ROUND(lugares.precio, 2)) as precio'),
                DB::raw('ROUND(lugares.precio, 2) as precio2'),
                'lugares.imagen as imagen',
                'lugares.imagen as imagen',
                'lugares.fechaPublicacion as fecha'
            ])
            ->join('usuarios', 'lugares.id_usuario', '=', 'usuarios.id_usuario')
            ->join('categorias', 'lugares.id_categoria', '=', 'categorias.id_categoria')
            ->join('municipio', 'lugares.id_municipio', '=', 'municipio.id_municipio')
            ->join('departamento', 'municipio.id_depto', '=', 'departamento.id_depto')
            ->where('usuarios.estado', true)
            ->where('categorias.estado', true)
            ->where('municipio.estado', true)
            ->where('lugares.estado', true)
            ->get();

            return response()->json($lstLugares);  
    }

    public function getTablaUsuariosByUserId(Request $user)
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
            ->where('rol.nombre_rol', 'EMPRENDEDOR')
            ->where('usuarios.id_usuario', $user->id_usuario)
            ->get();
    

            return response()->json($lstUsuarios);
        
    }

    public function getTablaMunicipioByIdDepto(Request $request)
    {
        $idDepto = $request->input('id');
        $muni = Municipio::where('id_depto', $idDepto)
        ->where('estado', true)
        ->select('id_municipio', 'municipio')
        ->get();

        return response()->json($muni);
    }
    

    public function destroy(Request $request)
    {
        $lugar = Lugares::find($request->input('id'));
        $lugar->estado = false;

        if ($lugar->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function save(Request $request)
    {
        $lugaresObj = new Lugares();
        $lugaresObj->id_usuario = $request->IdUsuario;
        $lugaresObj->id_categoria = $request->IdCategoria;
        $lugaresObj->nombre_lugar = $request->NombreLugar;
        $lugaresObj->descripcion = $request->Descripcion;
        $lugaresObj->id_municipio = $request->IdMunicipio;
        $lugaresObj->precio = $request->Precio;
        $lugaresObj->fechaPublicacion = Carbon::now();
        $lugaresObj->estado = true;

        if ($request->hasFile('imagenArchivo')) {
            $imageFile = $request->file('imagenArchivo');
            $imageContents = base64_encode(file_get_contents($imageFile->getRealPath()));
            $lugaresObj->imagen = $imageContents;
        }

        if ($lugaresObj->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function updateImage(Request $request)
    {
        $lugar = Lugares::find($request->idLugar);
        $lugar->id_usuario = $request->IdUsuario2;
        $lugar->id_categoria = $request->IdCategoria2;
        $lugar->nombre_lugar = $request->NombreLugar2;
        $lugar->descripcion = $request->Descripcion2;
        $lugar->id_municipio = $request->IdMunicipio2;
        $lugar->precio = $request->Precio2;

        if ($request->hasFile('imagenArchivo2')) {
            $imageFile = $request->file('imagenArchivo2');
            $imageContents = base64_encode(file_get_contents($imageFile->getRealPath()));
            $lugar->imagen = $imageContents;
        }

        if ($lugar->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function update(Request $request)
    {
        $lugar = Lugares::find($request->input('id_lugar'));
        $lugar->id_usuario = $request->input('id_usuario');
        $lugar->id_categoria = $request->input('id_categoria');
        $lugar->nombre_lugar = $request->input('nombre');
        $lugar->descripcion = $request->input('descripcion');
        $lugar->id_municipio = $request->input('id_municipio');
        $lugar->precio = $request->input('precio');

        if ($lugar->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function updateProfile(Request $request)
    {
        $user = Usuarios::find($request->input('id_usuario'));
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->edad = $request->input('edad');

        if ($user->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
