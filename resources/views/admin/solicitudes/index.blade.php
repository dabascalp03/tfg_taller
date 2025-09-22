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
    <h1 class="mb-4">Solicitudes de Vehículos</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Barra de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar solicitud...">

    <table class="table">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Placa</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="solicitudesTable">
            @foreach($solicitudes as $solicitud)
                <tr class="solicitud-row">
                    <td>{{ $solicitud->user->nombre }}</td>
                    <td>{{ $solicitud->marca }}</td>
                    <td>{{ $solicitud->modelo }}</td>
                    <td>{{ $solicitud->anio }}</td>
                    <td>{{ $solicitud->placa }}</td>
                    <td><span class="badge bg-{{ $solicitud->estado == 'pendiente' ? 'warning' : ($solicitud->estado == 'aprobado' ? 'success' : 'danger') }}">{{ ucfirst($solicitud->estado) }}</span></td>
                    <td>
                        @if($solicitud->estado == 'pendiente')
                        <form action="{{ route('admin.solicitudes.aprobar', $solicitud->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">Aprobar</button>
                            </form>
                            <form action="{{ route('admin.solicitudes.rechazar', $solicitud->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger btn-sm">Rechazar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $solicitudes->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Script para búsqueda dinámica -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.solicitud-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
