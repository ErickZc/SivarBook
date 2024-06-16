<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugares;
use App\Models\Usuarios;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Categorias;
use App\Models\Comentarios;
use App\Models\Lugares_Valoraciones;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Preguntas_Usuarios;
use App\Models\Preguntas;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class TuristaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
    public function showPreguntas(){
        $user = Auth::user();

        // Consultar si el usuario ha respondido las preguntas
        $preguntasUsuario = Preguntas_Usuarios::where('id_usuario', $user->id_usuario)->first();

        // Variable para indicar si el usuario debe responder las preguntas
        $debeResponderPreguntas = $preguntasUsuario === null;

        // Log::info('preguntasUsuario' . $preguntasUsuario);

        $preguntas = Preguntas::orderBy('id_pregunta', 'desc')
                    ->take(3)
                    ->select('id_pregunta', 'pregunta') // Aquí especificas las columnas que deseas seleccionar
                    ->get();

        $userId = Auth::user()->id_usuario;
        $turista = Usuarios::where('id_usuario', $userId)->where('estado', true)->firstOrFail();
        $lugares = Lugares::select([
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
        ->get();

        // Log::info('Debe responder preguntas? ' . $preguntas);

        return view('/turista/dashboard', compact('preguntas','debeResponderPreguntas','turista', 'lugares'));
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
        $userId = Auth::user()->id_usuario;
        $turista = Usuarios::where('id_usuario', $userId)->where('estado', true)->firstOrFail();
        $lugares = Lugares::select([
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
        ->get();

        return view('/turista/dashboard', compact('turista', 'lugares'));
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

        $turista = Usuarios::select([
            'usuarios.imagen',
            'usuarios.id_usuario',
            'usuarios.nombre',
            'usuarios.apellido',
            'usuarios.edad',
            'usuarios.correo'])
                            ->where('id_usuario', $userId)
                            ->where('estado', true)
                            ->first();

        if (!$turista) {
            abort(404);
        }

        return view('/turista/profile', compact('turista'));
    }

    public function findByMunicipio(Request $request)
    {
        try {
            $sValor = $request->input('sValor');
            $sTipo = $request->input('sTipo');

            if ($sTipo === "Dpto") {
                $idDpto = Departamento::where('departamento', 'like', '%' . $sValor . '%')->value('id_depto');
                $lugares = Lugares::select([
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
                ->where('municipio.id_depto', $idDpto)
                ->get();
                return response()->json($lugares);
            } else {
                $idMunicipio = Municipio::where('municipio', 'like', '%' . $sValor . '%')->value('id_municipio');
                $lugares = Lugares::where('id_municipio', $idMunicipio)->where('estado', true)->get();
                return response()->json($lugares);
            }
        } catch (Exception $ex) {
            return response()->json(false);
        }
    }

    public function getCategorias()
    {
        $categorias = Categorias::where('estado', 1)->get();
        return response()->json($categorias);
    }

    public function findByCategorias(Request $request)
    {
        try {
            $categoria = $request->input('sValor');

            $lugares = Lugares::select([
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
                ->where('categorias.id_categoria', $categoria)
                ->get();
                return response()->json($lugares);
        } catch (Exception $ex) {
            return response()->json(false);
        }
    }

    public function findByDescripcion(Request $request)
    {
        try {
            $sValor = $request->input('sValor');
            $palabrasDescripcion = explode(' ', $sValor);
    
            $lugares = Lugares::where('estado', true)->get()->filter(function ($l) use ($palabrasDescripcion) {
                foreach ($palabrasDescripcion as $palabra) {
                    if (stripos($l->descripcion, $palabra) !== false) {
                        return true;
                    }
                }
                return false;
            });
    
            return response()->json($lugares);
        } catch (Exception $ex) {
            return response()->json(['respuesta' => 'Error']);
        }
    }

    public function findByNombre(Request $request){
        try {
            $sValor = $request->input('sValor');
            $palabrasNombre = explode(' ', $sValor);
    
            $lugares = Lugares::where('estado', true)->get()->filter(function ($l) use ($palabrasNombre) {
                foreach ($palabrasNombre as $palabra) {
                    if (stripos($l->nombre_lugar, $palabra) !== false) {
                        return true;
                    }
                }
                return false;
            });
    
            return response()->json($lugares);
        } catch (Exception $ex) {
            return response()->json(['respuesta' => 'Error']);
        }
    }

    public function update(Request $request)
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

    public function updateImage(Request $request)
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

    public function postDetails($id)
    {
        // $userId = Session::get('profileUserId');
        // $user = Usuarios::find($userId)->get();
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
            return view('turista.postDetails', compact('lugar'));
        }else {
            
            abort(404);
        }

        // return view('/turista/postDetails', compact('lugar'));
    }

    public function allComments(Request $request)
    {
        $comments = Comentarios::join('usuarios', 'comentarios.id_usuario', '=', 'usuarios.id_usuario')
                    ->where('comentarios.id_lugar',$request->input('id'))
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

    public function createComment(Request $request)
    {
        $comentario = new Comentarios();
        $comentario->id_lugar = $request->input('IdLugar');
        $comentario->id_usuario = $request->input('IdUsuario');
        $comentario->comentario = $request->input('Comentario');
        $comentario->fecha = Carbon::now();
        $comentario->revision = '';
        $comentario->estado = true;

        if ($comentario->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function saveValoracion(Request $request)
    {
        $idValoracion = null;

        $existing = Lugares_Valoraciones::where('id_usuario', $request->input('idUsuario'))
            ->where('id_lugar', $request->input('idLugar'))
            ->first();

        if (!$existing) {
            $valoracionLugar = new Lugares_Valoraciones();
            $valoracionLugar->id_lugar = $request->input('idLugar');
            $valoracionLugar->id_valoracion = $request->input('puntuacion');
            $valoracionLugar->id_usuario = $request->input('idUsuario');
            $valoracionLugar->fecha = Carbon::now();
            $valoracionLugar->descripcion='';
            $valoracionLugar->save();
            $idValoracion = $valoracionLugar;
        } else {
            $existing->id_valoracion = $request->input('puntuacion');
            $idValoracion = $existing;

            $existing->save();
        }

        return response()->json($idValoracion);
    }   

    public function showValoracionesLugar(Request $request)
    {
        $valoracionLugar = Lugares_Valoraciones::where('id_lugar', $request->input('idLugar'))->average('id_valoracion');
        $valoracionFormateada = number_format($valoracionLugar, 1);
        return response()->json($valoracionFormateada);
    }

    public function getValoraciones(Request $request)
    {
        $valoraciones = Lugares_Valoraciones::join('usuarios', 'lugares_valoraciones.id_usuario', '=', 'usuarios.id_usuario')
                    ->where('lugares_valoraciones.id_lugar',$request->input('idLugar'))
                    ->orderByDesc('lugares_valoraciones.fecha')
                    ->select('lugares_valoraciones.fecha as fecha',
                             'usuarios.imagen as imagen',
                             'usuarios.nombre as nombre',
                             'usuarios.apellido as apellido',
                             'lugares_valoraciones.descripcion as comentario',
                             'usuarios.id_usuario as idUsuario',
                             'lugares_valoraciones.id_lValoracion as idComentario',
                             'lugares_valoraciones.id_valoracion as puntuacion')
                    ->get();

        return response()->json($valoraciones);
    }   

    public function valoracionUsuarioLugar(Request $request)
    {
        $idUsuario = 1;

        $valoracionLugar = Lugares_Valoraciones::where('id_usuario', $request->input('idUsuario'))
        ->where('id_lugar', $request->input('idLugar'))
        ->select('id_usuario as id_usuario')
        ->first();

        return response()->json($valoracionLugar);
    }         

    public function eliminarComentario(Request $request)
    {
        $objDel = Comentarios::findOrFail($request->input('id'));
        $objDel->estado = false;
        $objDel->save();
        return response()->json(true);
    }

    public function actualizarComentario(Request $request)
    {
        $objUpt = Comentarios::findOrFail($request->input('id'));
        $objUpt->comentario = $request->input('valor');
        $objUpt->save();
        return response()->json(true);
    }
}
