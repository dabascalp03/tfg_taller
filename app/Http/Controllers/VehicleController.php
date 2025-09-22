<?php

namespace App\Http\Controllers;  // Asegúrate de usar el namespace correcto para controladores

use App\Models\Vehicle;  // Asegúrate de importar el modelo Vehicle
use App\Models\User;
use Illuminate\Http\Request;

class VehicleController extends Controller  // Extiende de Controller, no de Model
{
    // Aquí puedes definir métodos para interactuar con tu modelo Vehicle
    public function index()
    {
        $vehicles = Vehicle::all(); // Paginación aplicada con 10 vehículos por página
        $users = User::all(); // Opcional, puedes paginar usuarios si es necesario
    
        return view('admin.vehicles.index', compact('vehicles', 'users'));
    }
    
public function edit($id)
{
    $vehicle = Vehicle::findOrFail($id); // Busca el vehículo o lanza un error 404
    
    $users = User::all(); // Obtiene todos los usuarios para el select

    return view('admin.vehicles.edit', compact('vehicle', 'users'));
}

// Método para actualizar el vehículo
public function update(Request $request, $id)
{
    $vehicle = Vehicle::findOrFail($id);

    // Validar los datos del formulario
    $request->validate([
        'id_usuario' => 'required|exists:usuarios,id',
        'marca' => 'required|string|max:50',
        'modelo' => 'required|string|max:50',
        'anio' => 'required|integer|min:1900|max:' . date('Y'),
        'matricula' => 'required|string|max:20|unique:coches,matricula,' . $id,
    ]);

    // Actualizar los datos del vehículo
    $vehicle->update([
        'id_usuario' => $request->id_usuario,
        'marca' => $request->marca,
        'modelo' => $request->modelo,
        'anio' => $request->anio,
        'matricula' => $request->matricula,
    ]);

    return redirect()->route('vehicles.index')->with('success', 'Vehículo actualizado correctamente');
}
public function create()
    {
        $users = User::all();
    
        return view('admin.vehicles.create', compact('users'));
    }

    // Guardar un nuevo vehículo en la base de datos
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'id_usuario' => 'required|exists:usuarios,id',
            'marca' => 'required|string|max:50',
            'modelo' => 'required|string|max:50',
            'anio' => 'required|integer|min:1900|max:' . date('Y'),
            'matricula' => 'required|string|max:20|unique:coches,matricula',
        ]);

        // Crear el vehículo
        Vehicle::create([
            'id_usuario' => $request->id_usuario,
            'marca' => $request->marca,
            'modelo' => $request->modelo,
            'anio' => $request->anio,
            'matricula' => $request->matricula,
        ]);

        return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo creado correctamente');
    }
    public function destroy($id)
{
    $vehicle = Vehicle::findOrFail($id); // Busca el vehículo o lanza un error 404
    $vehicle->delete(); // Elimina el vehículo

    return redirect()->route('admin.vehicles.index')->with('success', 'Vehículo eliminado correctamente.');
}
public function show($id)
    {
        // Obtener el coche con su información relacionada (reparaciones y facturas)
        $vehicle = Vehicle::with(['reparaciones', 'facturas'])
                          ->where('id', $id)
                          ->where('id_usuario', auth()->id()) // Aseguramos que el coche pertenece al usuario autenticado
                          ->first();

        if ($vehicle) {
            return response()->json($vehicle);
        }

        return response()->json(['error' => 'Coche no encontrado o no pertenece al usuario autenticado'], 404);
    }
    public function obtenerVehiculos($id)
{
    $vehiculos = Vehicle::where('id_usuario', $id)->get();

    if ($vehiculos->isEmpty()) {
        return response()->json(['message' => 'No se encontraron vehículos'], 404);
    }

    return response()->json($vehiculos);
}
public function getVehiclesByUser($id)
{
    $vehiculos = Vehicle::where('id_usuario', $id)->get();
    return response()->json($vehiculos);
}


}


