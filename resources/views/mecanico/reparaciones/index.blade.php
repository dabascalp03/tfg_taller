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
    <h1>Lista de Reparaciones</h1>
    
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
    <a href="{{ route('mecanico.reparaciones.create') }}" class="btn btn-success mb-3">Nueva Reparacion</a>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($repairs as $repair)
            <tr>
                <td>{{ $repair->id }}</td>
                <td>{{ $repair->vehicle->modelo ?? 'Sin vehículo' }}</td>
                <td>{{ $repair->descripcion }}</td>
                <td>{{ $repair->fecha }}</td>
                <td>{{ $repair->estado }}</td>
                <td>
                    <a href="{{ route('mecanico.reparaciones.edit', $repair->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <form action="{{ route('mecanico.reparaciones.destroy', $repair->id) }}" method="POST" class="d-inline delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger delete-button btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $repairs->links('pagination::bootstrap-5') }}
</div>
</div>

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