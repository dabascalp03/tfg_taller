<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Vehicle;
use App\Models\Repair;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function combinedSearch(Request $request)
    {
        try {
            $query = $request->input('query');
            
            // Crear un contenedor para los resultados
            $results = collect();
    
            if ($query) {
                // Buscar usuarios
                $users = User::where('nombre', 'like', "%{$query}%")
                    ->orWhere('email', 'like', "%{$query}%")
                    ->with(['vehicles.reparaciones', 'vehicles.facturas']) // Relacionar vehículos con reparaciones y facturas
                    ->get();
    
                // Buscar coches
                $vehicles = Vehicle::where('marca', 'like', "%{$query}%")
                    ->orWhere('modelo', 'like', "%{$query}%")
                    ->orWhere('matricula', 'like', "%{$query}%")
                    ->with(['reparaciones', 'facturas', 'user']) // Relacionar reparaciones, facturas y el propietario
                    ->get();
    
                // Combinar resultados
                $results = $results->merge($users)->merge($vehicles);
            }
    
            return response()->json($results); // Devuelve resultados como JSON
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
            return response()->json(['error' => 'Se produjo un error en el servidor.'], 500);
        }
    }
    

    
    

    

    
}
