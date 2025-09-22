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
    <h1 class="mb-4">Gestión de Restauraciones</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Barra de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar restauración...">

    <table class="table">
        <thead>
            <tr>
                <th>Título</th>
                <th>Cliente</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="restorationTable">
            @foreach($restauraciones as $restauracion)
                <tr class="restoration-row">
                    <td>{{ $restauracion->titulo }}</td>
                    <td>{{ $restauracion->cliente->nombre ?? 'Cliente desconocido' }}</td>
                    <td>{{ ucfirst($restauracion->estado) }}</td> <!-- Primera letra en mayúscula -->
                    <td>
                        <a href="{{ route('mecanico.restauraciones.edit', $restauracion->id) }}" class="btn btn-primary btn-sm">Editar</a>

                        <form action="{{ route('mecanico.restauraciones.destroy', $restauracion->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que deseas eliminar esta restauración?')">Eliminar</button>
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
        const rows = document.querySelectorAll('.restoration-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
