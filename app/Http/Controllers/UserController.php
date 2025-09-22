<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function indexNormal()
    {
        $users = User::all();
        return view('index', compact('users'));
    }
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Obtener el usuario por ID

        return view('admin.users.editUser', compact('user')); // Regresa la vista con el usuario
    }
    public function updateUser(Request $request, $id)
{
    $user = User::findOrFail($id);  // Encuentra al usuario por su ID
    $user->update($request->all()); // Actualiza los datos del usuario

    return redirect()->route('admin.users.index'); // Redirige al dashboard después de la actualización
}
public function destroyUser(User $user)
{
    // Eliminar al usuario
    $user->delete();

    // Redirigir con mensaje de éxito
    return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado con éxito');
}
}





