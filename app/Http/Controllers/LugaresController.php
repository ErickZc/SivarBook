<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugares;
use App\Models\Usuarios;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Categorias;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class LugaresController extends Controller
{
    protected $lugares;

    public function __construct(Lugares $lugares)
    {
        $this->lugares=$lugares;
    }

    //Paginas de Reportes
    public function lugaresporcategoriaGet()
    {
        $categorias = Categorias::where('estado', true)->get();
        return response()->json($categorias);
    }

    public function indexLugaresporcategoria()
    {
        return view('/admin/reporte/lugaresporcategoria');
    }

    public function lugarespormunicipioGet()
    {
        $municpio = Municipio::where('estado', true)->get();
        return response()->json($municpio);
    }

    public function indexLugarespormunicipio()
    {
        $departamentos = Departamento::where('estado', true)->get();
        $municipios = Municipio::where('estado', true)->get();

        return view('/admin/reporte/lugarespormunicipio', compact('departamentos', 'municipios'));
    }

    public function lugaresmejorpuntuadosGet()
    {
        $depto = Departamento::where('estado', true)->get();
        return response()->json($depto);
    }

    public function indexLugaresmejorpuntuados()
    {
        $departamentos = Departamento::where('estado', true)->get();

        return view('/admin/reporte/lugaresmejorpuntuados', compact('departamentos'));
    }

    public function lugaresgratuitosGet()
    {
        $depto = Departamento::where('estado', true)->get();
        return response()->json($depto);
    }

    public function indexLugaresgratuitos()
    {
        $departamentos = Departamento::where('estado', true)->get();

        return view('/admin/reporte/lugaresgratuitos', compact('departamentos'));
    }

    //Informacion del reporte

    public function pdfCategoria(Request $request){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
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
        ->where('lugares.id_categoria', $request->input('id'))
        ->get();

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfCategoria', compact('categoria','fecha'));
        return $pdf->download('pdfCategoria.pdf');
    }

    public function pdfCategoriaAll(){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
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

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfCategoria', compact('categoria','fecha'));
        return $pdf->download('pdfCategoriaAll.pdf');
    }
    
    public function pdfLugaresGratuitos(Request $request){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
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
        ->where('municipio.id_depto', $request->input('id'))
        ->where('lugares.precio', 0)
        ->get();

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfLugaresGratuitos', compact('categoria','fecha'));
        return $pdf->download('pdfLugaresGratuitos.pdf');
    }

    public function pdfLugaresGratuitosAll(){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
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
        ->where('lugares.precio', 0)
        ->get();

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfLugaresGratuitos', compact('categoria','fecha'));
        return $pdf->download('pdfLugaresGratuitosAll.pdf');
    }

    public function pdfLugaresMunicipio(Request $request){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
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
        ->where('lugares.id_municipio', $request->input('id'))
        ->get();

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfLugaresMunicipio', compact('categoria','fecha'));
        return $pdf->download('pdfLugaresPorMunicipio.pdf');
    }

    public function pdfLugaresMunicipioAll(){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
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

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfLugaresMunicipio', compact('categoria','fecha'));
        return $pdf->download('pdfLugaresPorMunicipioAll.pdf');
    }

    public function pdfLugaresMejorValorados(Request $request){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
            'lugares.id_municipio as idMunicipio',
            'municipio.id_depto as idDepto',
            'lugares.id_categoria as idCategoria',
            DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellido) as user'),
            'categorias.nombre_categoria as categoria',
            'lugares.nombre_lugar as nombre',
            'municipio.municipio as municipio',
            'departamento.departamento as departamento',
            DB::raw('CONCAT("$", ROUND(lugares.precio, 2)) as precio'),
            DB::raw('ROUND(lugares.precio, 2) as precio2'),
            'lugares.fechaPublicacion as fecha',
            DB::raw('AVG(lugares_valoraciones.id_valoracion) as promedio_valoracion'),
        ])
        ->join('usuarios', 'lugares.id_usuario', '=', 'usuarios.id_usuario')
        ->join('categorias', 'lugares.id_categoria', '=', 'categorias.id_categoria')
        ->join('municipio', 'lugares.id_municipio', '=', 'municipio.id_municipio')
        ->join('departamento', 'municipio.id_depto', '=', 'departamento.id_depto')
        ->join('lugares_valoraciones', 'lugares.id_lugar', '=', 'lugares_valoraciones.id_lugar')
        ->where('usuarios.estado', true)
        ->where('categorias.estado', true)
        ->where('municipio.estado', true)
        ->where('lugares.estado', true)
        ->where('departamento.id_depto', $request->input('id'))
        ->groupBy('lugares.id_lugar', 'usuarios.id_usuario', 'lugares.id_municipio', 'municipio.id_depto', 'lugares.id_categoria', 'usuarios.nombre', 'usuarios.apellido', 'categorias.nombre_categoria', 'lugares.nombre_lugar', 'municipio.municipio', 'departamento.departamento', 'lugares.precio', 'lugares.fechaPublicacion')
        ->havingRaw('AVG(lugares_valoraciones.id_valoracion) BETWEEN 4.5 AND 5')
        ->get();

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfLugaresMejorValorados', compact('categoria','fecha'));
        return $pdf->download('pdfLugaresMejorValorados.pdf');
    }

    public function pdfLugaresMejorValoradosAll(){

        $categoria = Lugares::select([
            'lugares.id_lugar as idLugar',
            'usuarios.id_usuario as idUser',
            'lugares.id_municipio as idMunicipio',
            'municipio.id_depto as idDepto',
            'lugares.id_categoria as idCategoria',
            DB::raw('CONCAT(usuarios.nombre, " ", usuarios.apellido) as user'),
            'categorias.nombre_categoria as categoria',
            'lugares.nombre_lugar as nombre',
            'municipio.municipio as municipio',
            'departamento.departamento as departamento',
            DB::raw('CONCAT("$", ROUND(lugares.precio, 2)) as precio'),
            DB::raw('ROUND(lugares.precio, 2) as precio2'),
            'lugares.fechaPublicacion as fecha',
            DB::raw('AVG(lugares_valoraciones.id_valoracion) as promedio_valoracion'),
        ])
        ->join('usuarios', 'lugares.id_usuario', '=', 'usuarios.id_usuario')
        ->join('categorias', 'lugares.id_categoria', '=', 'categorias.id_categoria')
        ->join('municipio', 'lugares.id_municipio', '=', 'municipio.id_municipio')
        ->join('departamento', 'municipio.id_depto', '=', 'departamento.id_depto')
        ->join('lugares_valoraciones', 'lugares.id_lugar', '=', 'lugares_valoraciones.id_lugar')
        ->where('usuarios.estado', true)
        ->where('categorias.estado', true)
        ->where('municipio.estado', true)
        ->where('lugares.estado', true)
        ->groupBy('lugares.id_lugar', 'usuarios.id_usuario', 'lugares.id_municipio', 'municipio.id_depto', 'lugares.id_categoria', 'usuarios.nombre', 'usuarios.apellido', 'categorias.nombre_categoria', 'lugares.nombre_lugar', 'municipio.municipio', 'departamento.departamento', 'lugares.precio', 'lugares.fechaPublicacion')
        ->havingRaw('AVG(lugares_valoraciones.id_valoracion) BETWEEN 4.5 AND 5')
        ->get();

        $fecha = now();
        $pdf = PDF::loadView('/admin/reporte/views/pdfLugaresMejorValorados', compact('categoria','fecha'));
        return $pdf->download('pdfLugaresMejorValoradosAll.pdf');
    }


    public function index()
    {
        $usuarios = Usuarios::where('usuarios.estado', true)
            ->join('rol', 'rol.id_rol', '=', 'usuarios.id_rol')
            ->where('rol.nombre_rol', "EMPRENDEDOR")
            ->get();
        $departamentos = Departamento::where('estado', true)->get();
        $municipios = Municipio::where('estado', true)->get();
        $categorias = Categorias::where('estado', true)->get();

        return view('/admin/lugares', compact('usuarios', 'departamentos', 'municipios', 'categorias'));
    }

    public function getTablaLugares()
    {
            $lstLugares = Lugares::select([
                'lugares.id_lugar as idLugar',
                'usuarios.id_usuario as idUser',
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
        $lugar = Lugares::find($request->input('idLugar'));
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
}
