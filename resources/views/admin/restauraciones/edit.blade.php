@extends('layouts.admin')

@section('content')
@php
    // Redirección si el usuario no es admin (id_rol == 1)
    if (!auth()->check() || auth()->user()->id_rol != 1) {
        header('Location: ' . url('/'));
        exit;
    }
@endphp
<div class="container">
    <h1>Editar Estado de Restauración</h1>

    <!-- Vista preliminar de los campos -->
    <div class="card mb-4">
        <div class="card-header">Vista Preliminar</div>
        <div class="card-body">
            <p><strong>ID:</strong> {{ $restauracion->id }}</p>
            <p><strong>Título:</strong> {{ $restauracion->titulo }}</p>
            <p><strong>Descripción:</strong> {{ $restauracion->descripcion }}</p>
            
            <p><strong>Imagen Antes:</strong></p>
            <div>
                @if($restauracion->imagen_antes)
                    <img src="{{ asset($restauracion->imagen_antes) }}" alt="Imagen Antes" width="200">
                @else
                    <span class="text-danger">Sin imagen disponible</span>
                @endif
            </div>
            
            <p><strong>Imagen Después:</strong></p>
            <div>
                @if($restauracion->imagen_despues)
                    <img src="{{ asset($restauracion->imagen_despues) }}" alt="Imagen Después" width="200">
                @else
                    <span class="text-danger">Sin imagen disponible</span>
                @endif
            </div>
            
            <p><strong>Estado:</strong> {{ ucfirst($restauracion->estado) }}</p>
        </div>
    </div>

    <!-- Formulario para actualizar el estado -->
    <form action="{{ route('admin.restauraciones.update', $restauracion->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
            <select name="estado" id="estado" class="form-control" required>
                <option value="pendiente" {{ $restauracion->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="aceptado" {{ $restauracion->estado == 'aceptado' ? 'selected' : '' }}>Aceptado</option>
                <option value="rechazado" {{ $restauracion->estado == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Actualizar Estado</button>
    </form>
</div>
@endsection
