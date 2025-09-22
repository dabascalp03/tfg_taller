<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Repair;
use App\Models\Vehicle;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
class RepairController extends Controller
{


        public function indexUsuario()
        {
            $reparaciones = Repair::where('id_usuario', auth()->id())->get(); // Obteniendo reparaciones del usuario
            return view('reparaciones.index', compact('reparaciones')); // Retornar vista reparaciones.index con los datos
        }

    

        public function index()
        {
            // Cargar la relación vehicle y la relación user dentro de vehicle
            $repairs = Repair::all();
        
            if ($repairs->isEmpty()) {
                return redirect()->route('admin.repairs.index')->with('error', 'No hay reparaciones para mostrar.');
            }
        
            return view('admin.repairs.index', compact('repairs'));
        }
        

    

    

    // Mostrar formulario de creación
    public function create()
{
    $usuarios = User::has('vehicles')->get(); // Solo usuarios que tengan coches

    // Obtener mecánicos (usuarios con id_rol = 2)
    $mecanicos = User::where('id_rol', 2)->get();

    return view('admin.repairs.create', compact('usuarios', 'mecanicos'));
}


    // Guardar reparación en la base de datos
    public function store(Request $request)
    {
    
        // Guarda la reparación
        Repair::create([
            'id_coche' => $request->id_coche,
            'id_mecanico' => $request->id_mecanico,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'estado' => $request->estado,
        ]);
    
        return redirect()->route('admin.repairs.index')->with('success', 'Reparación creada correctamente');
    }
    
    


    // Mostrar formulario de edición
// En el controlador de reparaciones
public function edit($id)
{
    $repair = Repair::with('vehicle.user')->findOrFail($id);

    if (!$repair->vehicle) {
        return redirect()->route('admin.repairs.index')->with('error', 'La reparación no tiene un coche asociado.');
    }

    if (!$repair->vehicle->user) {
        return redirect()->route('admin.repairs.index')->with('error', 'El vehículo no tiene un usuario asignado.');
    }

    // Obtener solo los vehículos del usuario de la reparación
    $mecanicos = User::where('id_rol', 2)->get();
    $vehiculos = Vehicle::where('id_usuario', $repair->vehicle->user->id)->get();

    return view('admin.repairs.edit', compact('repair', 'mecanicos', 'vehiculos'));
}


    
    
    
    
    
    
    

    


    // Actualizar reparación
    public function update(Request $request, $id)
    {
        $repair = Repair::findOrFail($id);

        // Verifica que la reparación pertenece a un coche del usuario autenticado
        if (Auth::user()->id_rol != 1 && $repair->vehicle->id_usuario !== Auth::id()) {
            return redirect()->route('admin.repairs.index')->with('error', 'No tienes permiso para modificar esta reparación.');
        }
        
        $request->validate([
            'id_coche' => 'required|exists:coches,id',
            'id_mecanico' => 'required|integer',
            'descripcion' => 'required|string',
            'fecha' => 'required|date',
            'estado' => 'required|in:pendiente,en proceso,finalizado'
        ]);

        $repair->update([
            'id_coche' => $request->id_coche,
            'id_mecanico' => $request->id_mecanico,
            'descripcion' => $request->descripcion,
            'fecha' => $request->fecha,
            'estado' => $request->estado,
        ]);
        
        return redirect()->route('admin.repairs.index')->with('success', 'Reparación actualizada correctamente');
    }

    // Eliminar reparación
    public function destroy($id)
    {
        $repair = Repair::findOrFail($id);
    
        // Verifica si el usuario es un administrador o si el usuario es el propietario del vehículo
        if (Auth::user()->id_rol != 1 && $repair->vehicle->id_usuario !== Auth::id()) {
            return redirect()->route('admin.repairs.index')->with('error', 'No tienes permiso para eliminar esta reparación.');
        }
    
        $repair->delete();
    
        return redirect()->route('admin.repairs.index')->with('success', 'Reparación eliminada correctamente');
    }
    
    

    public function getReparaciones($id) // Se cambia $vehicleId por $id
    {
        $reparaciones = Repair::where('id_coche', $id)->get();

        if ($reparaciones->isEmpty()) {
            return response()->json(['message' => 'No se encontraron reparaciones'], 404);
        }

        return response()->json($reparaciones);
    }
}

