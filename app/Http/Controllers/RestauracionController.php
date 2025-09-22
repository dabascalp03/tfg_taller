<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restauracion;

class RestauracionController extends Controller
{
    public function index() {
        $restauraciones = Restauracion::with('cliente', 'likes')
            ->where('estado', 'aceptado')
            ->get();
    
        return view('restauraciones.index', compact('restauraciones'));
    }
    
    

    public function create() {
        $restauraciones = Restauracion::where('estado', 'aceptado')->get();
        return view('restauraciones.index', compact('restauraciones')); // Vista del formulario
    }
    
    public function store(Request $request) {
        // Validar los datos enviados por el formulario
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string|max:1000',
            'imagen_antes' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'imagen_despues' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Generar nombres únicos para las imágenes
        $nombreAntes = time() . '_antes_' . $request->file('imagen_antes')->getClientOriginalName();
        $nombreDespues = time() . '_despues_' . $request->file('imagen_despues')->getClientOriginalName();
    
        // Almacenar las imágenes directamente en public/imagenes/
        $pathAntes = $request->file('imagen_antes')->move(public_path('imagenes/antes'), $nombreAntes);
        $pathDespues = $request->file('imagen_despues')->move(public_path('imagenes/despues'), $nombreDespues);
    
        // Guardar la información en la base de datos
        Restauracion::create([
            'id_cliente' => auth()->id(),
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen_antes' => 'imagenes/antes/' . $nombreAntes,
            'imagen_despues' => 'imagenes/despues/' . $nombreDespues,
            'estado' => 'pendiente',
        ]);
    
        // Redirigir al usuario con un mensaje de éxito
        return redirect()->route('restauraciones.create')->with('success', 'Proyecto enviado con éxito. Un administrador lo revisará pronto.');
    }
    
    
    public function search(Request $request)
    {
        $query = $request->input('query');
    
        $restauraciones = Restauracion::where('estado', 'aceptado') // Filtra solo aprobadas
                                      ->where(function($q) use ($query) {
                                          $q->where('titulo', 'LIKE', "%{$query}%")
                                            ->orWhere('descripcion', 'LIKE', "%{$query}%");
                                      })
                                      ->get();
    
        return response()->json(['html' => view('restauraciones.resultados', compact('restauraciones'))->render()]);
    }
    
    

    
    
}

