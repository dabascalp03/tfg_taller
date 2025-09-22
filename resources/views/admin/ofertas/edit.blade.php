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
    <h1 class="mb-4">Editar Oferta</h1>

    <form action="{{ route('admin.ofertas.update', $oferta) }}" method="POST" enctype="multipart/form-data">
    @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" class="form-control" id="titulo" name="titulo" value="{{ old('titulo', $oferta->titulo) }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required>{{ old('descripcion', $oferta->descripcion) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="fecha_expedicion" class="form-label">Fecha de Expiración</label>
            <input type="date" class="form-control" id="fecha_expedicion" name="fecha_expedicion" value="{{ old('fecha_expedicion', $oferta->fecha_expedicion->format('Y-m-d')) }}" required>
        </div>

        <div class="mb-3">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" class="form-control" id="imagen" name="imagen">
            <small class="text-muted">Deja en blanco si no deseas cambiar la imagen.</small>

            <div class="mt-2">
                <img src="{{ asset('storage/' . $oferta->imagen) }}" alt="{{ $oferta->titulo }}" width="150" class="rounded">
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Oferta</button>
        <a href="{{ route('admin.ofertas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
