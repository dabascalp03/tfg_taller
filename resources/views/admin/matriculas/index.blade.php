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
    <h1 class="mb-4">Solicitudes de Matrículas</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Barra de búsqueda -->
    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar solicitud de matrícula...">

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Tipo de Matrícula</th>
                <th>Número de Matrícula</th>
                <th>Fecha de Solicitud</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="matriculasTable">
            @foreach($matriculas as $matricula)
            <tr class="matricula-row">
                <td>{{ $matricula->id }}</td>
                <td>{{ $matricula->usuario->nombre }}</td>
                <td>{{ ucfirst($matricula->tipo_matricula) }}</td>
                <td>{{ $matricula->numero_matricula }}</td>
                <td>{{ $matricula->created_at->format('d/m/Y H:i') }}</td>
                <td>
                    <form action="{{ route('admin.matriculas.destroy', $matricula->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        {{ $matriculas->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Script para búsqueda dinámica -->
<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.matricula-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
