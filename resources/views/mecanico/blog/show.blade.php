@extends('layouts.app')

@section('title', 'Blog - Detalles del Post')

@push('styles')
    <style>
        .btn-volver{
            background-color: #ff8000; /* Color naranja */
            border-color: #ff8000; /* Borde naranja */
        }
        .btn-volver:hover{
            background-color: #e67300; /* Un tono más oscuro al pasar el cursor */
            border-color: #e67300;
        }
    </style>

@endpush

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4 fw-bold">{{ $post->title }}</h1>
    <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">

    
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-bold">Autor: {{ $post->author_name }}</h5>
            <p class="card-text">{{ $post->content }}</p>
            <p class="text-muted small">Publicado el: {{ $post->created_at->format('d-m-Y H:i') }}</p>
            @if($post->image_path)
                <img src="{{ asset('storage/' . $post->image_path) }}" alt="Imagen del Post" style="width: auto; max-height: 300px; object-fit: cover;">
            @endif


        </div>
    </div>
    
    <a href="{{ route('blog.index') }}" class="btn btn-volver mt-3">Volver a la Lista de Posts</a>
</div>
@endsection
