<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudVehiculo;
use Illuminate\Support\Facades\Auth;

class SolicitudVehiculoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'placa' => 'required|string|max:10|unique:solicitud_vehiculos,placa',
        ]);

        SolicitudVehiculo::create([
            'user_id' => Auth::id(),
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anio' => $request->anio,
            'placa' => $request->placa,
            'estado' => 'pendiente'
        ]);

        return redirect()->back()->with('success', 'Solicitud enviada. Un administrador la revisará.');
    }

    public function index()
{
    $solicitudes = SolicitudVehiculo::with('user')->paginate(10);
    return view('admin.solicitudes.index', compact('solicitudes'));
}

public function aprobar(SolicitudVehiculo $solicitud)
{
    // Crear el nuevo vehículo en la tabla 'vehiculos'
    \App\Models\Vehicle::create([
        'id_usuario' => $solicitud->user_id, // Asocia el mismo usuario
        'marca' => $solicitud->marca,
        'modelo' => $solicitud->modelo,
        'anio' => $solicitud->anio,
        'matricula' => $solicitud->placa, // Asigna el valor de placa a matricula
    ]);

    // Eliminar la solicitud de la tabla 'solicitud_vehiculos'
    $solicitud->delete();

    // Redirigir al listado de solicitudes con un mensaje de éxito
    return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud aprobada y vehículo creado.');
}



public function rechazar(SolicitudVehiculo $solicitud)
{
    // Actualizar el estado de la solicitud a 'rechazado'
    $solicitud->update(['estado' => 'rechazado']);

    // Redirigir al listado de solicitudes con un mensaje de éxito
    return redirect()->route('admin.solicitudes.index')->with('success', 'Solicitud rechazada.');
}


public function indexSolicitudes()
{
    $solicitudes = SolicitudVehiculo::with('user')->paginate(10);
    return view('mecanico.solicitudes.index', compact('solicitudes'));
}

public function aprobarSolicitudes(SolicitudVehiculo $solicitud)
{
    // Crear el nuevo vehículo en la tabla 'vehiculos'
    \App\Models\Vehicle::create([
        'id_usuario' => $solicitud->user_id, // Asocia el mismo usuario
        'marca' => $solicitud->marca,
        'modelo' => $solicitud->modelo,
        'anio' => $solicitud->anio,
        'matricula' => $solicitud->placa, // Asigna el valor de placa a matricula
    ]);

    // Eliminar la solicitud de la tabla 'solicitud_vehiculos'
    $solicitud->delete();

    // Redirigir al listado de solicitudes con un mensaje de éxito
    return redirect()->route('mecanico.solicitudes.index')->with('success', 'Solicitud aprobada y vehículo creado.');
}



public function rechazarSolicitudes(SolicitudVehiculo $solicitud)
{
    // Actualizar el estado de la solicitud a 'rechazado'
    $solicitud->update(['estado' => 'rechazado']);

    // Redirigir al listado de solicitudes con un mensaje de éxito
    return redirect()->route('mecanico.solicitudes.index')->with('success', 'Solicitud rechazada.');
}

}
