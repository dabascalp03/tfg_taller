<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use App\Models\User;

class MensajeAController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); 
        $receptores = User::where('id_rol', 3)->get(); // Usuarios con rol de cliente (id_rol = 3)
    
        // Contar mensajes no leídos por usuario
        foreach ($receptores as $receptor) {
            $receptor->mensajes_no_leidos = Mensaje::where('receptor_id', $user->id)
                ->where('emisor_id', $receptor->id)
                ->where('leido', false)
                ->count();
        }
    
        $receptor_id = $request->query('receptor_id');
        $mensajes = [];
    
        if ($receptor_id) {
            // Marcar mensajes como leídos cuando el usuario accede al chat
            Mensaje::where('receptor_id', $user->id)
                ->where('emisor_id', $receptor_id)
                ->where('leido', false)
                ->update(['leido' => true]);
    
            // Obtener los mensajes entre el mecánico y el cliente
            $mensajes = Mensaje::where(function ($query) use ($user, $receptor_id) {
                $query->where('emisor_id', $user->id)
                      ->where('receptor_id', $receptor_id);
            })
            ->orWhere(function ($query) use ($user, $receptor_id) {
                $query->where('emisor_id', $receptor_id)
                      ->where('receptor_id', $user->id);
            })
            ->orderBy('created_at', 'asc')
            ->get();
        }
    
        return view('mecanico.chat.index', compact('receptores', 'mensajes', 'receptor_id'));
    }
    
    

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'receptor_id' => 'required|exists:usuarios,id', // Cambiar 'users' a 'usuarios'
                'mensaje' => 'required|string|max:255',
            ]);
    
            // Obtener el usuario autenticado y el receptor desde la tabla 'usuarios'
            $emisor = auth()->user();
            $receptor = \DB::table('usuarios')->where('id', $validated['receptor_id'])->first();
    
            // Validar que ambos usuarios existen
            if (!$emisor || !$receptor) {
                return response()->json(['error' => 'Emisor o receptor no válido'], 400);
            }
    
            // Crear el mensaje en la tabla 'mensajes'
            $mensaje = Mensaje::create([
                'emisor_id' => $emisor->id,
                'receptor_id' => $receptor->id,
                'mensaje' => $validated['mensaje'],
            ]);
    
            // Cargar la relación del emisor para incluir su nombre en la respuesta
            $mensaje->load('emisor');
    
            // Retornar la respuesta con el mensaje y el nombre del emisor
            return response()->json([
                'mensaje' => [
                    'mensaje' => $mensaje->mensaje,
                    'emisor_id' => $mensaje->emisor_id,
                    'emisor_nombre' => $mensaje->emisor->nombre ?? 'Desconocido',
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Error al guardar el mensaje: ' . $e->getMessage());
            return response()->json(['error' => 'Error interno del servidor: ' . $e->getMessage()], 500);
        }
    }
    
    
    public function mensajesNoLeidos()
{
    $mensajesNoLeidos = Mensaje::where('receptor_id', auth()->id())
        ->where('leido', false)
        ->count();

    return response()->json(['noLeidos' => $mensajesNoLeidos]);
}

    
    
}
