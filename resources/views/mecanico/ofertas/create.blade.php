@extends('layouts.mecanico')

@section('content')
@php
    // Redirección si el usuario no es admin (id_rol == 2)
    if (!auth()->check() || auth()->user()->id_rol != 2) {
        header('Location: ' . url('/'));
        exit;
    }
@endphp
<div class="container">
    <h1 class="mb-4">Crear Nueva Oferta</h1>

    <form action="{{ route('mecanico.ofertas.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_expedicion" class="form-label">Fecha de Expiración</label>
            <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" value="{{ old('fecha_expedicion') }}" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen" required>
            <small class="text-muted">Solo formatos JPG, PNG, JPEG, GIF. Tamaño máximo: 2MB.</small>
        </div>

        <button type="submit" class="btn btn-success">Guardar Oferta</button>
        <a href="{{ route('mecanico.ofertas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
