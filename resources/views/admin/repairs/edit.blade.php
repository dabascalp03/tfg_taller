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
    <h2>Editar Reparación</h2>
    <form action="{{ route('repairs.update', $repair->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- Campo de Cliente (No Editable) -->
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Cliente</label>
            <input type="text" class="form-control" value="{{ $repair->vehicle->user->nombre ?? 'No asignado' }}" disabled>
        </div>

        <!-- Select de Vehículo -->
        <div class="mb-3">
            <label for="id_coche" class="form-label">Vehículo</label>
            <select id="id_coche" name="id_coche" class="form-control">
                <option value="">Seleccione un vehículo</option>
                @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id }}" {{ $vehiculo->id == $repair->id_coche ? 'selected' : '' }}>
                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }} - {{ $vehiculo->matricula }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Select de Mecánico -->
        <div class="mb-3">
            <label for="id_mecanico" class="form-label">Mecánico</label>
            <select id="id_mecanico" name="id_mecanico" class="form-control">
                <option value="">Seleccione un mecánico</option>
                @foreach($mecanicos as $mecanico)
                    <option value="{{ $mecanico->id }}" {{ $mecanico->id == $repair->id_mecanico ? 'selected' : '' }}>
                        {{ $mecanico->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Campo de Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3">{{ $repair->descripcion }}</textarea>
        </div>

        <!-- Campo de Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de la Reparación</label>
            <input type="date" id="fecha" name="fecha" class="form-control" value="{{ $repair->fecha }}">
        </div>

        <!-- Select de Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <!-- Select de Estado -->
            <select id="estado" name="estado" class="form-control">
                <option value="pendiente" {{ $repair->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="en proceso" {{ $repair->estado == 'en proceso' ? 'selected' : '' }}>En Proceso</option>
                <option value="finalizado" {{ $repair->estado == 'finalizado' ? 'selected' : '' }}>Finalizado</option>
            </select>

        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection