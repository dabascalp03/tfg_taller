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
        <h1 class="mb-4">Roles Disponibles</h1>


        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Paginación -->
        {{ $roles->links() }}
    </div>
@endsection
