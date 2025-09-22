<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        // Lógica para mostrar la vista de configuraciones
        return view('admin.settings'); // Asegúrate de que esta vista exista
    }
}
