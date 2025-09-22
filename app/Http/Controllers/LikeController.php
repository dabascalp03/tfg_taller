<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Restauracion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Restauracion $restauracion)
    {
        // Verificar si el usuario ya le dio "Me gusta"
        $like = $restauracion->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);
    
        // Devolver una respuesta JSON con los datos necesarios
        return response()->json([
            'liked' => true,
            'count' => $restauracion->likes()->count(),  // Número total de "Me gusta"
        ]);
    }
    
    public function destroy(Restauracion $restauracion)
    {
        // Eliminar el "Me gusta" del usuario autenticado
        $restauracion->likes()->where('user_id', auth()->id())->delete();
    
        // Devolver una respuesta JSON con los datos necesarios
        return response()->json([
            'liked' => false,
            'count' => $restauracion->likes()->count(),  // Número total de "Me gusta"
        ]);
    }
    
    public function destroyById(Like $like)
    {
        // Solo permite borrar si el like pertenece al usuario autenticado
        if ($like->user_id === auth()->id()) {
            $like->delete();
            $count = $like->restauracion->likes()->count();
            return response()->json([
                'liked' => false,
                'count' => $count,
            ]);
        }
        return response()->json(['error' => 'No autorizado'], 403);
    }
}

