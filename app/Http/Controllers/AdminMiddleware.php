<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller; // IMPORTANTE: Asegurar esta línea

class AdminController extends Controller
{
    public function __construct()
    {
        // Aplica middleware para proteger las rutas
        $this->middleware(['auth', 'role:1']);  // Asumiendo que 'role:1' es el middleware que has definido para roles de admin
    }

    public function index()
    {
        // Lógica para el dashboard del administrador
        return view('admin.dashboard');
    }
}


