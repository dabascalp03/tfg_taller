<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Oferta;

class OfertaController extends Controller
{
    public function index()
    {
        $ofertas = Oferta::orderBy('fecha_expedicion', 'desc')->get()->chunk(3);
        return view('index', compact('ofertas'));
    }
    
    
    public function edit(Oferta $oferta)
    {
        return view('admin.ofertas.edit', compact('oferta'));
    }
    
    public function create()
    {
        return view('admin.ofertas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'fecha_expedicion' => 'required|date',
        ]);

        $imagenPath = $request->file('imagen')->store('ofertas', 'public');

        Oferta::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $imagenPath,
            'fecha_expedicion' => $request->fecha_expedicion,
        ]);

        return redirect()->route('admin.ofertas.index')->with('success', 'Oferta creada correctamente.');
    }

    public function indexAdmin()
    {
        // Recupera las ofertas ordenadas por fecha de expedición y las pagina
        $ofertas = Oferta::orderBy('fecha_expedicion', 'desc')->paginate(10);

        // Retorna la vista con las ofertas disponibles
        return view('admin.ofertas.index', compact('ofertas'));
    }

    public function update(Request $request, Oferta $oferta)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_expedicion' => 'required|date',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Si el usuario sube una nueva imagen, guardarla correctamente
        if ($request->hasFile('imagen')) {
            $nombreImagen = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
            
            // Mueve la imagen desde el archivo temporal a la carpeta pública
            $request->file('imagen')->storeAs('public/ofertas', $nombreImagen);
            
            // Guarda solo la ruta relativa en la base de datos
            $oferta->imagen = 'ofertas/' . $nombreImagen;
        }
    
        // Actualiza los demás datos
        $oferta->update([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'fecha_expedicion' => $request->fecha_expedicion,
            'imagen' => $oferta->imagen, // Mantiene la imagen anterior si no se cambia
        ]);
    
        return redirect()->route('admin.ofertas.index')->with('success', 'Oferta actualizada correctamente.');
    }
    
    
    
    
        public function destroy(Oferta $oferta)
        {
            $oferta->delete();
            return redirect()->route('admin.ofertas.index')->with('success', 'Oferta eliminada correctamente.');
        }
    
        public function show(Oferta $oferta)
        {
            return view('ofertas.show', compact('oferta'));
        }

        public function editOfertas(Oferta $oferta)
        {
            return view('mecanico.ofertas.edit', compact('oferta'));
        }
        
        public function createOfertas()
        {
            return view('mecanico.ofertas.create');
        }
    
        public function storeOfertas(Request $request)
        {
            $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'fecha_expedicion' => 'required|date',
            ]);
    
            $imagenPath = $request->file('imagen')->store('ofertas', 'public');
    
            Oferta::create([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'imagen' => $imagenPath,
                'fecha_expedicion' => $request->fecha_expedicion,
            ]);
    
            return redirect()->route('mecanico.ofertas.index')->with('success', 'Oferta creada correctamente.');
        }
    
        public function indexOfertas()
        {
            // Recupera las ofertas ordenadas por fecha de expedición y las pagina
            $ofertas = Oferta::orderBy('fecha_expedicion', 'desc')->paginate(10);
    
            // Retorna la vista con las ofertas disponibles
            return view('mecanico.ofertas.index', compact('ofertas'));
        }
    
        public function updateOfertas(Request $request, Oferta $oferta)
        {
            $request->validate([
                'titulo' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha_expedicion' => 'required|date',
                'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
        
            // Si el usuario sube una nueva imagen, guardarla correctamente
            if ($request->hasFile('imagen')) {
                $nombreImagen = time() . '.' . $request->file('imagen')->getClientOriginalExtension();
                
                // Mueve la imagen desde el archivo temporal a la carpeta pública
                $request->file('imagen')->storeAs('public/ofertas', $nombreImagen);
                
                // Guarda solo la ruta relativa en la base de datos
                $oferta->imagen = 'ofertas/' . $nombreImagen;
            }
        
            // Actualiza los demás datos
            $oferta->update([
                'titulo' => $request->titulo,
                'descripcion' => $request->descripcion,
                'fecha_expedicion' => $request->fecha_expedicion,
                'imagen' => $oferta->imagen, // Mantiene la imagen anterior si no se cambia
            ]);
        
            return redirect()->route('mecanico.ofertas.index')->with('success', 'Oferta actualizada correctamente.');
        }
        
        
        
        
            public function destroyOfertas(Oferta $oferta)
            {
                $oferta->delete();
                return redirect()->route('mecanico.ofertas.index')->with('success', 'Oferta eliminada correctamente.');
            }
        

    }
