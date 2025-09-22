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
    <h1 class="mb-4">Gestión de Usuarios</h1>

    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar usuario...">


    <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-sm mb-3">Nuevo Usuario</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="userTable">
    @foreach($users as $user)
    <tr class="user-row">
        <td>{{ $user->id }}</td>
        <td>{{ $user->nombre }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d-m-Y') }}</td>
        <td>
            <a href="{{ route('admin.users.editUser', $user->id) }}" class="btn btn-warning btn-sm">Editar</a>
            
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $users->links('pagination::bootstrap-5') }}
</div>

<script>
    document.getElementById('searchInput').addEventListener('keyup', function() {
        const filter = this.value.toLowerCase();
        const rows = document.querySelectorAll('.user-row');

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>



</div>
@endsection
