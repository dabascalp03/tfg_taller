<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use Illuminate\Support\Facades\Auth;

class MatriculaController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'tipo_matricula' => 'required',
            'numero_matricula' => 'required|regex:/^[0-9]{4} [A-Z]{3}$/|unique:matriculas,numero_matricula',
        ]);

        Matricula::create([
            'id_usuario' => Auth::id(), // ID del usuario autenticado
            'tipo_matricula' => $request->tipo_matricula,
            'numero_matricula' => strtoupper($request->numero_matricula),
        ]);

        return redirect()->back()->with('success', 'Matrícula solicitada correctamente.');
    }

    public function index()
{
    // Obtener todas las matrículas con la información del usuario
    $matriculas = Matricula::with('usuario')->latest()->paginate(10);

    return view('admin.matriculas.index', compact('matriculas'));
}


public function destroy($id)
{
    Matricula::findOrFail($id)->delete();
    return redirect()->route('admin.matriculas.index')->with('success', 'Matrícula eliminada correctamente.');
}

public function indexMatriculas()
{
    // Obtener todas las matrículas con la información del usuario
    $matriculas = Matricula::with('usuario')->latest()->paginate(10);

    return view('mecanico.matriculas.index', compact('matriculas'));
}


public function destroyMatriculas($id)
{
    Matricula::findOrFail($id)->delete();
    return redirect()->route('mecanico.matriculas.index')->with('success', 'Matrícula eliminada correctamente.');
}

}


