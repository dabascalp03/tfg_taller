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
    <h1 class="mb-4">Gestión de Vehículos</h1>
    
    <a href="{{ route('mecanico.vehicles.create') }}" class="btn btn-success mb-3">Nuevo Vehículo</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Matricula</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
            <tr>
                <td>{{ $vehiculo->id }}</td>
                <td>{{ $vehiculo->marca }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->matricula }}</td>
                <td>{{ \Carbon\Carbon::parse($vehiculo->created_at)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('mecanico.vehicles.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    
                    <form action="{{ route('mecanico.vehicles.destroy', $vehiculo->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este vehículo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center">
        {{ $vehiculos->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
