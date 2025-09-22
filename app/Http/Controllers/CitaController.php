<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cita;

class CitaController extends Controller
{

    public function index()
{
    // Obtener todas las citas del usuario autenticado
    $citas = \App\Models\Cita::where('usuario_id', auth()->id())->get();

    // Retornar una vista con las citas (asegúrate de tener la vista "index")
    return view('citas.index', compact('citas'));
}

    /**
     * Almacena una nueva cita en la base de datos.
     */
    public function store(Request $request)
{
    try {
        // Convierte el formato de la hora
        $horaFormateada = date('H:i', strtotime($request->hora));
        
        // Sobrescribe el campo `hora` en la solicitud
        $request->merge(['hora' => $horaFormateada]);

        // Ahora realiza la validación
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required|date_format:H:i', // Formato correcto
            'servicio' => 'required|string',
        ]);

        // Guarda los datos en la base de datos
        Cita::create([
            'usuario_id' => auth()->id(),
            'fecha' => $request->fecha,
            'hora' => $request->hora, // Usa el campo validado
            'servicio' => $request->servicio,
        ]);

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error('Error al crear la cita: ' . $e->getMessage());
        return response()->json(['error' => 'Error en el servidor.'], 500);
    }
}



}
