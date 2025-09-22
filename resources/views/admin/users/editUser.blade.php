@extends('layouts.admin')

@section('content')
@php
    // Redirección si el usuario no es admin (id_rol == 1)
    if (!auth()->check() || auth()->user()->id_rol != 1) {
        header('Location: ' . url('/'));
        exit;
    }
@endphps
    <div class="container">
        <h2 class="text-black">Editar Usuario</h2>

        @if(Session::has('success'))
    <div class="alert alert-success mt-2">
        <strong>{{ Session::get('success') }}</strong>
    </div>
@endif

@if(Session::has('error'))
    <div class="alert alert-danger mt-2">
        <strong>{{ Session::get('error') }}</strong>
    </div>
@endif


        <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="nombre" class="text-black">Nombre:</label>
        <input type="text" name="nombre" class="form-control" value="{{ old('nombre', $user->nombre) }}" required>
    </div>

    <div class="form-group">
        <label for="email" class="text-black">Correo Electrónico:</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
    </div>

    <div class="form-group">
        <label for="username" class="text-black">Nombre de Usuario:</label>
        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
    </div>

    <div class="form-group">
        <label for="password" class="text-black">Contraseña (opcional):</label>
        <input type="password" name="password" class="form-control" placeholder="Déjalo en blanco si no deseas cambiarla">
    </div>
    <div class="form-group">
    <label for="password_confirmation" class="text-black">Confirmar Contraseña:</label>
    <input type="password" name="password_confirmation" class="form-control">
</div>


    <div class="form-group">
        <label for="id_rol" class="text-black">Rol:</label>
        <select name="id_rol" class="form-control" required>
            <option value="1" {{ $user->id_rol == 1 ? 'selected' : '' }}>Administrador</option>
            <option value="2" {{ $user->id_rol == 2 ? 'selected' : '' }}>Mecanico</option>
            <option value="3" {{ $user->id_rol == 3 ? 'selected' : '' }}>Cliente</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
</form>

    </div>
@endsection




