<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    protected $departamento;

    public function __construct(Departamento $departamento)
    {
        $this->departamento=$departamento;
    }

    public function index()
    {
        $departamento = Departamento::where('estado', true)->get();

        return view('/admin/departamentos', compact('departamento'));
    }

    public function getTablaDepartamentos()
    {
        $lstDepartamentos = Departamento::select([
            'departamento.id_depto as id_depto',
            'departamento.departamento as departamento'
        ])
        ->where('departamento.estado', true)
        ->get();
    
        return response()->json($lstDepartamentos);
        
    }

    public function save(Request $request)
    {

        $departamento = new Departamento();
        $departamento->departamento = $request->departamento;
        $departamento->estado = true;

        if ($departamento->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function update(Request $request)
    {
        $departamento = Departamento::find($request->id_depto);
        $departamento->departamento = $request->departamento;
    
        if ($departamento->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    public function destroy(Request $request)
    {
        $departamento = Departamento::find($request->id_depto);
        $departamento->estado = false;

        if ($departamento->save()) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }
}
