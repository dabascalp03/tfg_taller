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
    <h1 class="mb-4">Crear Nueva Factura</h1>

    <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary mb-3">Volver a la lista</a>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.invoices.store') }}" method="POST">
                @csrf

                <!-- Selección de Cliente -->
                <div class="form-group">
                    <label for="id_usuario">Cliente</label>
                    <select name="id_usuario" id="id_usuario" class="form-control" required>
                        <option value="">Seleccione un cliente</option>
                        @foreach($usuarios as $client)
                            <option value="{{ $client->id }}">{{ $client->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Selección de Vehículo -->
                <div class="form-group">
                    <label for="id_coche">Vehículo</label>
                    <select name="id_coche" id="id_coche" class="form-control" required disabled>
                        <option value="">Seleccione un vehículo</option>
                    </select>
                </div>

                <!-- Selección de Reparación -->
                <div class="form-group">
                    <label for="id_reparacion">Reparación</label>
                    <select name="id_reparacion" id="id_reparacion" class="form-control" required disabled>
                        <option value="">Seleccione una reparación</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="monto">Monto (€)</label>
                    <input type="number" name="monto" id="monto" class="form-control" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Crear Factura</button>
            </form>
        </div>
    </div>
</div>

<!-- AJAX para actualizar vehículos y reparaciones -->

<script>
$(document).ready(function () {
    // Cuando se cambia el cliente
    $('#id_usuario').change(function () {
        var userId = $(this).val();
        $('#id_coche').prop('disabled', true).html('<option>Cargando...</option>');
        $('#id_reparacion').prop('disabled', true).html('<option>Seleccione un vehículo primero</option>');  // Reset reparaciones

        if (userId) {
            $.ajax({
                url: '/obtener-vehiculos/' + userId,
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var opciones = '<option value="">Seleccione un vehículo</option>';
                    data.forEach(function (vehicle) {
                        opciones += `<option value="${vehicle.id}">${vehicle.marca} ${vehicle.modelo} (${vehicle.matricula})</option>`;
                    });
                    $('#id_coche').prop('disabled', false).html(opciones);
                },
                error: function () {
                    alert('Error al cargar los vehículos');
                }
            });
        }
    });

    // Cuando se cambia el vehículo
    $('#id_coche').change(function () {
        var vehicleId = $(this).val();
        $('#id_reparacion').prop('disabled', true).html('<option>Cargando...</option>');

        if (vehicleId) {
            $.ajax({
                url: '/obtener-reparaciones/' + vehicleId,  // Cambia la URL según tu lógica
                type: 'GET',
                dataType: 'json',
                success: function (data) {
                    var opciones = '<option value="">Seleccione una reparación</option>';
                    data.forEach(function (repair) {
                        opciones += `<option value="${repair.id}">${repair.descripcion}</option>`;
                    });
                    $('#id_reparacion').prop('disabled', false).html(opciones);
                },
                error: function () {
                    alert('Error al cargar las reparaciones');
                }
            });
        }
    });
});
</script>


@endsection




