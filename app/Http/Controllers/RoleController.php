<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        // Obtener todos los roles disponibles en la tabla roles
        $roles = Role::paginate(10); // Paginación (10 roles por página)

        // Pasar los roles a la vista
        return view('admin.roles.index', compact('roles'));
    }

    public function destroy($id)
{
    // Buscar el rol por su ID y eliminarlo
    $role = Role::findOrFail($id);
    $role->delete();

    // Redirigir con un mensaje de éxito
    return redirect()->route('admin.roles.index')->with('success', 'Rol eliminado correctamente.');
}
public function create()
{
    return view('admin.roles.create');
}

public function store(Request $request)
{
    // Validar y almacenar el nuevo rol
    $request->validate([
        'name' => 'required|unique:roles,name',
    ]);

    Role::create([
        'name' => $request->name,
    ]);

    return redirect()->route('admin.roles.index')->with('success', 'Rol creado correctamente.');
}

}

