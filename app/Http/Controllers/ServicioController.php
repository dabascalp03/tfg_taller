<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $service = $request->query('service'); // Captura el parámetro de la URL

        $validServices = ['aceites', 'frenado', 'climatizacion', 'amortiguadores', 'matriculas'];

        // Verifica que el servicio solicitado sea válido
        if (!in_array($service, $validServices)) {
            $service = 'default'; // Si no es válido, carga una vista por defecto
        }

        return view('servicios.index', compact('service'));
    }
}






