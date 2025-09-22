<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensaje;
use App\Models\User;

class MensajeController extends Controller
{
    // Vista para el chat de clientes
    public function index(Request $request)
    {
        $user = auth()->user();
        $receptores = User::where('id_rol', 2)->get(); // Usuarios con rol de mecánico (id_rol = 2)
    
        // Contar mensajes no leídos por mecánico
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
    
            // Obtener los mensajes entre el usuario y el mecánico
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
    
        return view('chat.index', compact('receptores', 'mensajes', 'receptor_id'));
    }
    

    // Guardar mensajes desde el cliente
    public function store(Request $request)
    {
        $validated = $request->validate([
            'receptor_id' => 'required|exists:usuarios,id',
            'mensaje' => 'required|string|max:255',
        ]);

        // Crear mensaje
        $mensaje = Mensaje::create([
            'emisor_id' => auth()->id(),
            'receptor_id' => $validated['receptor_id'],
            'mensaje' => $validated['mensaje'],
            'fecha' => now(),
        ]);

        return response()->json(['mensaje' => $mensaje]);
    }
    
    
    public function mensajesNoLeidosUsuario()
{
    $mensajesNoLeidos = Mensaje::where('receptor_id', auth()->id())
        ->where('leido', false)
        ->count();

    return response()->json(['noLeidos' => $mensajesNoLeidos]);
}

}
