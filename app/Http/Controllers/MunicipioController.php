<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Departamento;

class MunicipioController extends Controller
{
    protected $municipio;

    public function __construct(Municipio $municipio)
    {
        $this->municipio=$municipio;
    }

    public function index()
    {
        $municipio = Municipio::where('estado', true)->get();
        $departamento = Departamento::where('estado', true)->get();

        return view('/admin/municipios', compact('municipio','departamento'));
    }

    public function getTablaMunicipios()
    {
        $lstMunicipios = Municipio::select([
            'municipio.id_municipio as id_municipio',
            'municipio.municipio as municipio',
            'municipio.id_depto as id_depto',
            'departamento.departamento as departamento'
        ])
        ->join('departamento', 'municipio.id_depto', '=', 'departamento.id_depto') // Corrección aquí
        ->where('municipio.estado', true)
        ->where('departamento.estado', true)
        ->get();

        return response()->json($lstMunicipios);  
    }


    public function save(Request $request)
    {

        $municipio = new Municipio();
        $municipio->id_depto = $request->id_depto;
        $municipio->municipio = $request->municipio;

        if ($municipio->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function update(Request $request)
    {
        $municipio = Municipio::find($request->id_municipio);
        $municipio->municipio = $request->municipio;
        $municipio->id_depto = $request->id_depto;
    
        if ($municipio->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function destroy(Request $request)
    {
        $municipio = Municipio::find($request->id_municipio);
        $municipio->estado = false;

        if ($municipio->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
