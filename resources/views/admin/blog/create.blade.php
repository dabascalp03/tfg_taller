@extends('layouts.admin')

@section('title', 'Blog - Crear Post con Imagen')

@section('content')
@php
    // Redirección si el usuario no es admin (id_rol == 1)
    if (!auth()->check() || auth()->user()->id_rol != 1) {
        header('Location: ' . url('/'));
        exit;
    }
@endphp
<div class="container mt-4">
    <h1 class="text-center mb-4">Crear Nuevo Post</h1>
    
    <form action="{{ route('admin.blog.store') }}" method="POST" class="dropzone" id="image-upload">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>
        <div class="form-group mb-3">
            <label for="content">Contenido</label>
            <textarea name="content" id="content" class="form-control" rows="5" required></textarea>
        </div>
        <div class="form-group mb-3">
            <label for="author_name">Autor</label>
            <input type="text" name="author_name" id="author_name" class="form-control" required>
        </div>
        
        <!-- Área de Dropzone -->
        <div class="form-group">
            <label for="image">Imagen</label>
            <div class="dropzone" id="my-dropzone"></div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Guardar</button>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
<script>
    Dropzone.options.myDropzone = {
    url: "{{ route('admin.blog.storeImage') }}", // Ruta para subir las imágenes
    maxFiles: 1, // Solo permite una imagen
    maxFilesize: 2, // Tamaño máximo de archivo en MB
    acceptedFiles: 'image/*', // Acepta solo imágenes
    headers: {
        'X-CSRF-TOKEN': "{{ csrf_token() }}" // Agrega el token CSRF para seguridad
    },
    success: function (file, response) {
        // Almacenar la ruta de la imagen en un campo oculto (para enviarla con el formulario)
        let form = document.getElementById('image-upload');
        let input = document.createElement('input');
        input.type = 'hidden';
        input.name = 'image_path';
        input.value = response.image_path; // Ruta devuelta por el servidor
        form.appendChild(input);
    },
    error: function (file, response) {
        console.error(response); // Maneja errores
    }
};

</script>
@endsection
