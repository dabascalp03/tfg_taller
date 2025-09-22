<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validación de credenciales
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Verificar el rol del usuario después de la autenticación
            if (Auth::user()->id_rol == 1) {
                return redirect()->route('admin.dashboard'); // Redirigir al dashboard del admin
            } else if (Auth::user()->id_rol == 2) {
                return redirect()->route('mecanico.dashboard'); // Redirigir al dashboard del mecánico
            } else if (Auth::user()->id_rol == 3) {
                return redirect()->route('dashvehiculos'); // Redirigir al dashboard del cliente
            }
        }

        // Si la autenticación falla, redirigir con mensaje de error
        return back()->with('error', 'Usuario o contraseña incorrectos.');
    }

    // Cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Verificar el rol del usuario después de la autenticación
            if (Auth::user()->id_rol != 1 && Auth::user()->id_rol != 2 && Auth::user()->id_rol != 3) {
                return redirect()->route('index'); // Redirigir al dashboard del admin
            }
        }
        return redirect->route('index');
    }

    // Especificar que se usará el campo 'username' para la autenticación
    public function username()
    {
        return 'username';
    }
}


