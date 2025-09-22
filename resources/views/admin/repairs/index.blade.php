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
    <h1 class="mb-4">Lista de Reparaciones</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <!-- Barra de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar reparación...">

    <!-- Botón para añadir una nueva reparación -->
    <a href="{{ route('admin.repairs.create') }}" class="btn btn-success btn-sm mb-3">Nueva Reparación</a>

    <!-- Tabla de reparaciones -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo (Marca y Modelo)</th>
                <th>Usuario (Nombre)</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="repairTable">
            @foreach($repairs as $repair)
            <tr class="repair-row">
                <td>{{ $repair->id }}</td>
                <!-- Muestra marca y modelo -->
                <td>
                    @if($repair->vehicle)
                        {{ $repair->vehicle->marca }} - {{ $repair->vehicle->modelo }}
                    @else
                        Sin vehículo
                    @endif
                </td>
                <!-- Muestra el nombre del usuario -->
                <td>
                    @if($repair->vehicle && $repair->vehicle->user)
                        {{ $repair->vehicle->user->nombre }}
                    @else
                        Sin usuario
                    @endif
                </td>
                <td>{{ $repair->descripcion }}</td>
                <td>{{ $repair->fecha }}</td>
                <td>{{ $repair->estado }}</td>
                <td>
                    <a href="{{ route('admin.repairs.edit', $repair->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <form action="{{ route('admin.repairs.destroy', $repair->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta reparación?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Script para búsqueda dinámica -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.repair-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const deleteForms = document.querySelectorAll(".delete-form");
    deleteForms.forEach(form => {
        form.addEventListener("submit", function(event) {
            event.preventDefault();
            if (confirm("¿Estás seguro de que deseas eliminar esta reparación?")) {
                this.submit();
            }
        });
    });
});
</script>
@endsection
