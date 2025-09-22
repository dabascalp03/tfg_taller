<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


use App\Http\Controllers\Controller; // Esta línea es clave

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Middleware de autenticación

        $this->middleware(function ($request, $next) {
            if (Auth::check() && Auth::user()->id_rol !== 1) {
                if ($request->route('id') == Auth::id()) {
                    Auth::logout();
                    return redirect()->route('login')->with('error', 'Tu sesión ha sido cerrada por cambios en tu cuenta.');
                }
                return redirect('/')->with('error', 'No tienes permisos para acceder.');
            }
        
            return $next($request);
        });
        
    }

    public function index()
    {
        $users = User::all(); // Obtener todos los usuarios
    
        return view('admin.users.index', compact('users')); // Pasar $users a la vista
    }

    public function indexDash()
    {
        $users = User::all(); // Obtener todos los usuarios
    
        return view('admin.dashboard', compact('users')); // Pasar $users a la vista
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.editUser', ['user' => $user]);
    }
    

    public function update(Request $request, $id)
{
    try {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . $id,
            'username' => 'required|string|unique:usuarios,username,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'id_rol' => 'required|integer',
        ]);

        $user = User::findOrFail($id);

        $user->nombre = $request->nombre;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->id_rol = $request->id_rol;

        // Solo actualizar la contraseña si el campo no está vacío
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado con éxito.');
    } catch (\Illuminate\Database\QueryException $e) {
        return redirect()->back()->with('error', '⚠️ El nombre de usuario ya está en uso. Intenta con otro.');
    }
}

    



public function destroy(User $user)
{
    // Eliminar al usuario
    $user->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado con éxito');
}

public function createUser()
{
    return view('admin.users.create'); // Vista para crear un nuevo usuario
}

public function storeUser(Request $request)
{
    try {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email',
            'username' => 'required|string|unique:usuarios,username',
            'password' => 'required|min:6|confirmed',
            'id_rol' => 'required|integer',
        ]);

        User::create([
            'nombre' => $request->nombre,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'id_rol' => $request->id_rol,
        ]);

        return redirect()->back()->with('success', '✅ Usuario creado correctamente.');

    } catch (\Exception $e) {
        return redirect()->back()->with('error', '⚠️ Hubo un error al crear el usuario. Verifica los datos e intenta de nuevo.');
    }
}
public function testMethod()
{
    return 'Test';
}


}




    


