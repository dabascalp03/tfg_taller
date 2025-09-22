@extends('layouts.app')

@section('title', 'TodoMotor - Blog')

@push('styles')
<style>
    .card {
        display: flex;
        flex-direction: column; /* Asegura que el contenido interno esté alineado verticalmente */
        justify-content: space-between; /* Distribuye el espacio entre los elementos */
        height: 100%; /* Iguala la altura de todas las tarjetas */
    }

    /* Estilo para los botones "Leer más" */
    .btn-vermas {
        background-color: #ff8000; /* Color naranja */
        border-color: #ff8000; /* Borde naranja */
    }

    .btn-vermas:hover {
        background-color: #e67300; /* Un tono más oscuro al pasar el cursor */
        border-color: #e67300;
    }
</style>
@endpush

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 fw-bold">Blog del Taller</h1>
    <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">

    
    @if($posts->isEmpty())
        <div class="alert alert-info text-center">No hay posts disponibles por ahora.</div>
    @else
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4 d-flex"> <!-- d-flex asegura que las tarjetas se alineen -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                            <p class="card-text">{{ Str::limit($post->content, 150, '...') }}</p>
                            <p class="text-muted">Autor: {{ $post->author_name }}</p>
                            <p class="text-muted small">Publicado: {{ $post->created_at->format('d-m-Y H:i') }}</p>
                            <a href="{{ route('blog.show', $post->id) }}" class="btn  btn-sm btn-vermas" >Leer más</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
