<?php

namespace App\Http\Controllers;

use App\Models\Restauracion;
use Illuminate\Http\Request;

class AdminRestauracionController extends Controller
{
    public function index() {
        $restauraciones = Restauracion::with('cliente')->get(); // Incluye la relación con cliente
        return view('admin.restauraciones.index', compact('restauraciones'));
    }
    
    public function edit($id) {
        $restauracion = Restauracion::findOrFail($id);
        return view('admin.restauraciones.edit', compact('restauracion'));
    }
    
    public function update(Request $request, $id) {
        $request->validate([
            'estado' => 'required|in:aceptado,rechazado',
        ]);
    
        $restauracion = Restauracion::findOrFail($id);
        $restauracion->estado = $request->estado;
        $restauracion->save();
    
        return redirect()->route('admin.restauraciones.index')->with('success', 'Estado actualizado con éxito.');
    }
    
    public function destroy($id) {
        $restauracion = Restauracion::findOrFail($id);
    
        // Elimina las imágenes asociadas, si es necesario
        if (file_exists(public_path($restauracion->imagen_antes))) {
            unlink(public_path($restauracion->imagen_antes));
        }
        if (file_exists(public_path($restauracion->imagen_despues))) {
            unlink(public_path($restauracion->imagen_despues));
        }
    
        // Elimina el registro de la base de datos
        $restauracion->delete();
    
        return redirect()->route('admin.restauraciones.index')->with('success', 'Restauración eliminada con éxito.');
    }

    public function indexRestauraciones() {
        $restauraciones = Restauracion::with('cliente')->get(); // Incluye la relación con cliente
        return view('mecanico.restauraciones.index', compact('restauraciones'));
    }
    
    public function editRestauraciones($id) {
        $restauracion = Restauracion::findOrFail($id);
        return view('mecanico.restauraciones.edit', compact('restauracion'));
    }
    
    public function updateRestauraciones(Request $request, $id) {
        $request->validate([
            'estado' => 'required|in:aceptado,rechazado',
        ]);
    
        $restauracion = Restauracion::findOrFail($id);
        $restauracion->estado = $request->estado;
        $restauracion->save();
    
        return redirect()->route('mecanico.restauraciones.index')->with('success', 'Estado actualizado con éxito.');
    }
    
    public function destroyRestauraciones($id) {
        $restauracion = Restauracion::findOrFail($id);
    
        // Elimina las imágenes asociadas, si es necesario
        if (file_exists(public_path($restauracion->imagen_antes))) {
            unlink(public_path($restauracion->imagen_antes));
        }
        if (file_exists(public_path($restauracion->imagen_despues))) {
            unlink(public_path($restauracion->imagen_despues));
        }
    
        // Elimina el registro de la base de datos
        $restauracion->delete();
    
        return redirect()->route('mecanico.restauraciones.index')->with('success', 'Restauración eliminada con éxito.');
    }
    
}
