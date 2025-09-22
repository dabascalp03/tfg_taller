<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class CitaAController extends Controller
{
    public function index()
    {
        $citas = Cita::with('usuario')->get();
        return view('admin.citas.index', compact('citas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio' => 'required|string',
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        Cita::create($request->all());

        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('admin.citas.index')->with('success', 'Cita completada y eliminada.');
    }

    public function ocupadas()
    {
        return response()->json(Cita::select('fecha', 'hora')->get());
    }

    public function indexCitas()
    {
        $citas = Cita::with('usuario')->get();
        return view('mecanico.citas.index', compact('citas'));
    }

    public function storeCitas(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio' => 'required|string',
            'cliente_id' => 'required|exists:clientes,id'
        ]);

        Cita::create($request->all());

        return response()->json(['success' => true]);
    }

    public function destroyCitas($id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();

        return redirect()->route('mecanico.citas.index')->with('success', 'Cita completada y eliminada.');
    }

    public function ocupadasCitas()
    {
        return response()->json(Cita::select('fecha', 'hora')->get());
    }
}
