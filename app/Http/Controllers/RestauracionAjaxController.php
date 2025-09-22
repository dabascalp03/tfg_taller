<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restauracion;

class RestauracionAjaxController extends Controller
{
    public function index()
    {
        $restauraciones = Restauracion::all();
        return view('restauraciones.index', compact('restauraciones'));
    }

    public function loadPartial(Request $request)
    {
        $restauracion = $request->input('restauracion');

        switch ($restauracion) {
            case 'golf':
                $data = Restauracion::find(1);
                return view('restauraciones.partials.golf', ['restauracion' => $data]);
            case 'peugeot':
                $data = Restauracion::find(2);
                return view('restauraciones.partials.peugeot', ['restauracion' => $data]);
            case 'bmw':
                $data = Restauracion::find(3);
                return view('restauraciones.partials.bmw', ['restauracion' => $data]);
            case 'golf_r32':
                $data = Restauracion::find(4);
                return view('restauraciones.partials.golf_r32', ['restauracion' => $data]);
            case 'mv_agusta':
                $data = Restauracion::find(5);
                return view('restauraciones.partials.mv_agusta', ['restauracion' => $data]);
            case 'bmw_m3':
                $data = Restauracion::find(6);
                return view('restauraciones.partials.bmw_m3', ['restauracion' => $data]);
                     
            default:
                return response()->json(['error' => 'Restauración no encontrada'], 404);
        }
    }
}


