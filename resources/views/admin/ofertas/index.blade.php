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
    <h1 class="mb-4">Gestión de Ofertas</h1>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar oferta...">

    <a href="{{ route('admin.ofertas.create') }}" class="btn btn-success btn-sm mb-3">Nueva Oferta</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Fecha de Expiración</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="offerTable">
        @foreach($ofertas as $oferta)
        <tr class="offer-row">
            <td>{{ $oferta->id }}</td>
            <td>{{ $oferta->titulo }}</td>
            <td>{{ $oferta->descripcion }}</td>
            <td><img src="{{ asset('storage/' . $oferta->imagen) }}" alt="{{ $oferta->titulo }}" width="100"></td>
            <td>{{ $oferta->fecha_expedicion->format('d-m-Y') }}
            </td>
            <td>
                <a href="{{ route('admin.ofertas.edit', $oferta->id) }}" class="btn btn-warning btn-sm">Editar</a>

                <form action="{{ route('admin.ofertas.destroy', $oferta->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta oferta?')">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $ofertas->links('pagination::bootstrap-5') }}
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.offer-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
@endsection
