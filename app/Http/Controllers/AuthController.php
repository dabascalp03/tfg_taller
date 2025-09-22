<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;  // Asegúrate de importar la clase Auth
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;  // Si usas Hash para comprobar la contraseña

class AuthController extends Controller
{
    // Función para iniciar sesión
    
    public function login(Request $request)
{
    // Validar los datos de entrada
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Obtener el usuario por su nombre de usuario
    $user = User::where('username', $request->username)->first();

    if ($user) {
        if (Hash::check($request->password, $user->password)) {
            // Si las contraseñas coinciden
            Auth::login($user);
            return redirect()->intended($this->redirectTo());
        }
    }
    

    // Si llegamos aquí, las credenciales son incorrectas
    return back()->withErrors(['username' => 'Las credenciales son incorrectas.']);
}

    

    

    
    

    // Función de redirección según el rol del usuario
    protected function redirectTo()
    {
        // Verifica el rol del usuario y redirige a la ruta correspondiente
        if (Auth::user()->id_rol == 1) { // Si el rol es 'admin' (suponiendo que el rol admin es 1)
            return route('admin.dashboard'); // Redirigir al dashboard del admin
        } elseif (Auth::user()->id_rol == 3) { // Si el rol es 'usuario'
            return route('dashvehiculos'); // Redirigir al dashboard del usuario
        }
        elseif (Auth::user()->id_rol == 2) { // Si el rol es otro tipo de usuario
            return route('mecanico.dashboard'); // Redirigir a la ruta correspondiente
        }
    }

    // Función para registrar un usuario
    public function register(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'username' => 'required|string|unique:usuarios,username|max:50',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Buscar el ID del rol "Cliente"
        $rolCliente = Role::where('nombre', 'cliente')->first();
        if (!$rolCliente) {
            return back()->with('error', 'Error: No existe el rol Cliente.');
        }

        // Crear usuario con el rol por defecto
        // Al registrar un usuario, debes cifrar la contraseña
$user = User::create([
    'nombre' => $request->nombre,
    'email' => $request->email,
    'username' => $request->username,
    'password' => Hash::make($request->password), // Cifrar la contraseña aquí
    'id_rol' => $rolCliente->id,
]);


        return redirect()->route('login')->with('success', 'Registro exitoso. Ahora puedes iniciar sesión.');
    }

    // Función para cerrar sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Sesión cerrada exitosamente.');
    }
}

