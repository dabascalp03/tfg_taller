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
    <h2>Crear Nueva Reparación</h2>
    <form action="{{ route('repairs.store') }}" method="POST">
        @csrf

        <!-- Select de Cliente -->
        <div class="mb-3">
            <label for="usuario_id" class="form-label">Cliente</label>
            <select id="usuario_id" name="usuario_id" class="form-control">
                <option value="">Seleccione un cliente</option>
                @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->id }}">{{ $usuario->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Select de Vehículo -->
        <div class="mb-3">
            <label for="id_coche" class="form-label">Vehículo</label>
            <select id="id_coche" name="id_coche" class="form-control">
                <option value="">Seleccione un vehículo</option>
            </select>
        </div>

        <!-- Select de Mecánico -->
        <div class="mb-3">
            <label for="id_mecanico" class="form-label">Mecánico</label>
            <select id="id_mecanico" name="id_mecanico" class="form-control">
                <option value="">Seleccione un mecánico</option>
                @foreach($mecanicos as $mecanico)
                    <option value="{{ $mecanico->id }}">{{ $mecanico->nombre }}</option>
                @endforeach
            </select>
        </div>

        <!-- Campo de Descripción -->
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea id="descripcion" name="descripcion" class="form-control" rows="3"></textarea>
        </div>

        <!-- Campo de Fecha -->
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha de la Reparación</label>
            <input type="date" id="fecha" name="fecha" class="form-control">
        </div>

        <!-- Select de Estado -->
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select id="estado" name="estado" class="form-control">
                <option value="pendiente">Pendiente</option>
                <option value="en proceso">En Proceso</option>
                <option value="finalizado">Finalizado</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>

<script>
    document.getElementById('usuario_id').addEventListener('change', function() {
        var usuarioId = this.value;
        var vehiculoSelect = document.getElementById('id_coche');
        vehiculoSelect.innerHTML = '<option value="">Seleccione un vehículo</option>';

        if (usuarioId) {
            fetch(`/vehiculos/porUsuario/${usuarioId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length === 0) {
                        alert("Este usuario no tiene vehículos registrados.");
                    } else {
                        data.forEach(vehiculo => {
                            let option = document.createElement('option');
                            option.value = vehiculo.id;
                            option.textContent = `${vehiculo.marca} ${vehiculo.modelo} - ${vehiculo.matricula}`;
                            vehiculoSelect.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    });
</script>

@endsection
