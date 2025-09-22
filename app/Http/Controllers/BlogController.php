<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    // Mostrar todos los posts
    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('blog.index', compact('posts'));
    }
    public function indexAdmin()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('admin.blog.index', compact('posts'));
    }

    // Mostrar un post específico
    public function show($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('admin.blog.show', compact('post'));
    }

    // (Opcional) Método para crear nuevos posts
    public function create()
    {
        return view('admin.blog.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author_name' => 'required|max:100',
            'image_path' => 'nullable|string',
        ]);
    
        BlogPost::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author_name' => $request->input('author_name'),
            'image_path' => $request->input('image_path'),
        ]);
    
        return redirect()->route('admin.blog.index')->with('success', 'Post creado exitosamente.');
    }
    

    public function edit($id)
    {
        // Buscar el post por su ID
        $post = BlogPost::findOrFail($id);
    
        // Retornar la vista de edición con los datos del post
        return view('admin.blog.edit', compact('post'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author_name' => 'required|max:100',
            'image_path' => 'nullable|string', // Ruta de la imagen desde Dropzone
        ]);
    
        // Buscar el post por su ID
        $post = BlogPost::findOrFail($id);
    
        // Actualizar los campos del post
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->author_name = $request->input('author_name');
    
        // Verificar si se subió una nueva imagen con Dropzone
        if ($request->has('image_path')) {
            $post->image_path = $request->input('image_path');
        }
    
        // Guardar los cambios
        $post->save();
    
        return redirect()->route('admin.blog.index')->with('success', 'Post actualizado exitosamente.');
    }
    

    public function storeImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Guardar la imagen en el almacenamiento público
        $path = $request->file('file')->store('blog_images', 'public');
    
        return response()->json(['image_path' => $path]);
    }
    

    public function indexBlog()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        return view('mecanico.blog.index', compact('posts'));
    }

    public function createBlog()
    {
        return view('mecanico.blog.create');
    }

    public function storeBlog(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author_name' => 'required|max:100',
            'image_path' => 'nullable|string',
        ]);
    
        BlogPost::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'author_name' => $request->input('author_name'),
            'image_path' => $request->input('image_path'),
        ]);
    
        return redirect()->route('mecanico.blog.index')->with('success', 'Post creado exitosamente.');
    }
    

    public function editBlog($id)
    {
        // Buscar el post por su ID
        $post = BlogPost::findOrFail($id);
    
        // Retornar la vista de edición con los datos del post
        return view('mecanico.blog.edit', compact('post'));
    }
    
    public function updateBlog(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'author_name' => 'required|max:100',
            'image_path' => 'nullable|string', // Ruta de la imagen desde Dropzone
        ]);
    
        // Buscar el post por su ID
        $post = BlogPost::findOrFail($id);
    
        // Actualizar los campos del post
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->author_name = $request->input('author_name');
    
        // Verificar si se subió una nueva imagen con Dropzone
        if ($request->has('image_path')) {
            $post->image_path = $request->input('image_path');
        }
    
        // Guardar los cambios
        $post->save();
    
        return redirect()->route('mecanico.blog.index')->with('success', 'Post actualizado exitosamente.');
    }
    

    public function storeImageBlog(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Guardar la imagen en el almacenamiento público
        $path = $request->file('file')->store('blog_images', 'public');
    
        return response()->json(['image_path' => $path]);
    }

}
