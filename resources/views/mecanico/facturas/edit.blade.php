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
    <h2>Editar Factura</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('mecanico.facturas.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="id_usuario" class="form-label">Cliente</label>
            <select name="id_usuario" id="id_usuario" class="form-control" required>
    @foreach ($usuarios as $usuario)
        <option value="{{ $usuario->id }}" {{ $invoice->id_usuario == $usuario->id ? 'selected' : '' }}>
            {{ $usuario->nombre }}
        </option>
    @endforeach
</select>

        </div>

        <div class="mb-3">
            <label for="id_coche" class="form-label">Vehículo</label>
            <select name="id_coche" id="id_coche" class="form-control" required>
                @foreach ($coches as $coche)
                    <option value="{{ $coche->id }}" {{ $invoice->id_coche == $coche->id ? 'selected' : '' }}>
                        {{ $coche->marca }} {{ $coche->modelo }} ({{ $coche->matricula }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_reparacion" class="form-label">Reparación</label>
            <select name="id_reparacion" id="id_reparacion" class="form-control" required>
                @foreach ($reparaciones as $reparacion)
                    <option value="{{ $reparacion->id }}" {{ $invoice->id_reparacion == $reparacion->id ? 'selected' : '' }}>
                        {{ $reparacion->descripcion }} - ${{ $reparacion->costo }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto</label>
            <input type="number" name="monto" id="monto" class="form-control" value="{{ $invoice->monto }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar Factura</button>
        <a href="{{ route('mecanico.facturas.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const usuarioSelect = document.getElementById('id_usuario');
    const cocheSelect = document.getElementById('id_coche');
    const reparacionSelect = document.getElementById('id_reparacion');

    // Seleccionar el valor previamente seleccionado en 'usuario' al cargar la página
    const selectedUserId = usuarioSelect.value;
    if (selectedUserId) {
        loadCoches(selectedUserId);
    }

    // Seleccionar el valor previamente seleccionado en 'vehículo' al cargar la página
    const selectedCocheId = cocheSelect.value;
    if (selectedCocheId) {
        loadReparaciones(selectedCocheId);
    }

    usuarioSelect.addEventListener('change', function () {
        const userId = this.value;
        if (userId) {
            loadCoches(userId);
            reparacionSelect.innerHTML = '<option value="">Seleccione una reparación</option>'; // Reiniciar reparaciones
        }
    });

    cocheSelect.addEventListener('change', function () {
        const cocheId = this.value;
        if (cocheId) {
            loadReparaciones(cocheId);
        }
    });

    // Función para cargar coches
    function loadCoches(userId) {
        fetch(`/obtener-vehiculos/${userId}`)
            .then(response => response.json())
            .then(data => {
                cocheSelect.innerHTML = '<option value="">Seleccione un vehículo</option>';
                data.forEach(coche => {
                    cocheSelect.innerHTML += `<option value="${coche.id}" ${coche.id == selectedCocheId ? 'selected' : ''}>${coche.marca} ${coche.modelo} (${coche.matricula})</option>`;
                });
            });
    }

    // Función para cargar reparaciones
    function loadReparaciones(cocheId) {
        fetch(`/obtener-reparaciones/${cocheId}`)
            .then(response => response.json())
            .then(data => {
                reparacionSelect.innerHTML = '<option value="">Seleccione una reparación</option>';
                data.forEach(reparacion => {
                    reparacionSelect.innerHTML += `<option value="${reparacion.id}" ${reparacion.id == reparacionSelect.value ? 'selected' : ''}>${reparacion.descripcion} - $${reparacion.costo}</option>`;
                });
            });
    }
});

</script>

@endsection

