<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categorias;

class CategoriaController extends Controller
{
    protected $categorias;

    public function __construct(Categorias $categorias)
    {
        $this->categorias=$categorias;
    }

    public function index()
    {
        $categorias = Categorias::where('estado', true)->get();

        return view('/admin/categorias', compact('categorias'));
    }

    public function getTablaCategorias()
    {
        $lstCategoria = Categorias::select([
            'categorias.id_categoria as id_categoria',
            'categorias.nombre_categoria as nombre_categoria'
        ])
        ->where('categorias.estado', true)
        ->get();
    
        return response()->json($lstCategoria);
        
    }

    public function save(Request $request)
    {

        $categorias = new Categorias();
        $categorias->nombre_categoria = $request->nombre_categoria;

        if ($categorias->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function update(Request $request)
    {
        $categorias = Categorias::find($request->id_categoria);
        $categorias->nombre_categoria = $request->nombre_categoria;
    
        if ($categorias->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function destroy(Request $request)
    {
        $categorias = Categorias::find($request->id_categoria);
        $categorias->estado = false;

        if ($categorias->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
