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
    <h1 class="mb-4">Gestión de Vehículos</h1>

    <!-- Barra de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar vehículo...">

    <a href="{{ route('admin.vehicles.create') }}" class="btn btn-success btn-sm mb-3">Nuevo Vehículo</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matrícula</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="vehicleTable">
            @foreach($vehicles as $vehicle)
            <tr class="vehicle-row">
                <td>{{ $vehicle->id }}</td>
                <td>{{ $vehicle->marca }}</td>
                <td>{{ $vehicle->modelo }}</td>
                <td>{{ $vehicle->matricula }}</td>
                <td>{{ \Carbon\Carbon::parse($vehicle->created_at)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('admin.vehicles.edit', $vehicle->id) }}" class="btn btn-warning btn-sm">Editar</a>

                    <form action="{{ route('admin.vehicles.destroy', $vehicle->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este vehículo?')">Eliminar</button>
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
        const rows = document.querySelectorAll('.vehicle-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
