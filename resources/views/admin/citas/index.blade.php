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
    <h1 class="mb-4">Lista de Citas</h1>

    <!-- Barra de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar cita...">

    @if($citas->isEmpty())
        <div class="alert alert-info">No hay citas programadas actualmente.</div>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="citasTable">
                @foreach ($citas as $cita)
                    <tr class="cita-row">
                        <td>{{ $cita->id }}</td>
                        <td>{{ $cita->usuario->nombre }}</td>
                        <td>{{ $cita->fecha }}</td>
                        <td>{{ $cita->hora }}</td>
                        <td>
                            <form action="{{ route('citas.eliminar', $cita->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-success btn-sm" onclick="return confirm('¿Estás seguro de completar esta cita?')">Completar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>

<!-- Script para búsqueda dinámica -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.cita-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
