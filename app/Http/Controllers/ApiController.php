<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;

class ApiController extends Controller
{
    /**
     * Obtener vehículos de un usuario.
     */
    public function getVehiculosPorUsuario($usuarioId) {
        $vehiculos = Vehiculo::where('id_usuario', $usuarioId)->get();
        return response()->json($vehiculos);
    }
    

    /**
     * Obtener reparaciones de un vehículo.
     */
    public function getReparaciones($vehiculoId)
    {
        return Reparacion::where('id_coche', $vehiculoId)->get();
    }

    /**
     * Obtener facturas de una reparación.
     */
    public function getFacturas($reparacionId)
    {
        return Factura::where('id_reparacion', $reparacionId)->get();
    }
}
