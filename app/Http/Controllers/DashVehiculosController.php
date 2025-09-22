<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Repair;
use App\Models\Like;
use App\Models\Invoice;
use Illuminate\Http\Request;

class DashVehiculosController extends Controller
{
    // Método que muestra la página principal del dashboard
    public function index(Request $request)
    {
        $user = auth()->user(); 
    
        // Obtener todos los coches del usuario 
        $coches = Vehicle::where('id_usuario', $user->id)->get();
        $receptor_id = $request->query('receptor_id'); // Obtener el receptor_id desde la URL
        $citas = $user->citas;

    
        // Obtener las reparaciones facturas asociadas a los coches del usuario, además de los likes
        $cochesIds = $coches->pluck('id')->toArray();
        $reparaciones = Repair::whereIn('id_coche', $cochesIds)->get();
        $facturas = Invoice::whereIn('id_coche', $cochesIds)->get();
        $likes = Like::with('restauracion')->where('user_id', $user->id)->get();
    
        // Retornar la vista con los datos
        return view('dashvehiculos', compact('likes', 'user', 'reparaciones', 'facturas', 'coches', 'receptor_id','citas'));
    }
    

    // Método para obtener los coches del usuario como JSON
    public function getCoches()
    {
        $coches = Vehicle::where('id_usuario', auth()->id())->get();
        return response()->json($coches);
    }

    public function getDatosCoche($cocheId)
    {
        // Buscar el coche
        $coche = Vehicle::findOrFail($cocheId);

        // Recuperar reparaciones y facturas asociadas al coche
        $reparaciones = Repair::where('id_coche', $cocheId)->get();
        $facturas = Invoice::where('id_coche', $cocheId)->get();

        // Aquí puedes implementar lógica para paginar las reparaciones y las facturas si es necesario
        // Por ejemplo, si quieres mostrar un máximo de 5 reparaciones y facturas por petición:
        $reparacionesLimitadas = Repair::where('id_coche', $cocheId)->limit(5)->get();
        $facturasLimitadas = Invoice::where('id_coche', $cocheId)->limit(5)->get();

        // Determinar si hay más reparaciones o facturas disponibles
        $moreReparaciones = $reparaciones->count() > 5;
        $moreFacturas = $facturas->count() > 5;

        return response()->json([
            'coche' => $coche,
            'reparaciones' => $reparacionesLimitadas,
            'facturas' => $facturasLimitadas,
            'moreReparaciones' => $moreReparaciones,
            'moreFacturas' => $moreFacturas,
        ]);
    }
    
    }
    

