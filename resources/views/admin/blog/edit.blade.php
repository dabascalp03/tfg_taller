@extends('layouts.admin')

@section('title', 'Blog - Editar Post')

@section('content')
@php
    // Redirección si el usuario no es admin (id_rol == 1)
    if (!auth()->check() || auth()->user()->id_rol != 1) {
        header('Location: ' . url('/'));
        exit;
    }
@endphp
<div class="container mt-4">
    <h1 class="text-center mb-4">Editar Post</h1>
    <form action="{{ route('admin.blog.update', $post->id) }}" method="POST" id="edit-post-form">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Título</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $post->title }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="content">Contenido</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ $post->content }}</textarea>
        </div>
        <div class="form-group mb-3">
            <label for="author_name">Autor</label>
            <input type="text" name="author_name" id="author_name" class="form-control" value="{{ $post->author_name }}" required>
        </div>
        
        <!-- Imagen Actual -->
        @if($post->image_path)
            <div class="mb-3">
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen del Post" style="max-width: 100%; height: auto;">
            </div>
        @endif

        <!-- Área de Dropzone -->
        <div class="form-group">
            <label for="image">Cambiar Imagen</label>
            <div class="dropzone" id="my-dropzone">
    <p>Arrastra y suelta tu imagen aquí o haz clic para seleccionarla.</p>
</div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Actualizar</button>
        <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary mt-3">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    Dropzone.autoDiscover = false;

    console.log("Inicializando Dropzone...");

    var myDropzone = new Dropzone("#my-dropzone", {
        url: "{{ route('admin.blog.storeImage') }}",
        maxFiles: 1,
        maxFilesize: 2,
        acceptedFiles: 'image/*',
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        init: function () {
            console.log("Dropzone inicializada correctamente.");

            let myDropzone = this;

            @if ($post->image_path)
                let mockFile = { name: "{{ basename($post->image_path) }}", size: 12345 };
                myDropzone.displayExistingFile(mockFile, "{{ asset('storage/' . $post->image_path) }}");
            @endif

            this.on("success", function (file, response) {
                console.log("Imagen subida:", response.image_path);
                let form = document.getElementById("edit-post-form");
                let input = document.createElement("input");
                input.type = "hidden";
                input.name = "image_path";
                input.value = response.image_path;
                form.appendChild(input);
            });

            this.on("error", function (file, response) {
                console.error("Error al subir la imagen:", response);
            });
        }
    });
});




</script>
@endsection

