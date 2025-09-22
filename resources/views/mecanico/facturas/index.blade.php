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
    <h1 class="mb-4">Gestión de Facturas</h1>
    
    <a href="{{ route('mecanico.facturas.create') }}" class="btn btn-success mb-3">Nueva Factura</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Vehículo</th>
                <th>Reparación</th>
                <th>Monto</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
            <tr>
                <td>{{ $invoice->id }}</td>
                <td>
                    @if($invoice->vehicle)
                        {{ $invoice->vehicle->marca }} {{ $invoice->vehicle->modelo }} ({{ $invoice->vehicle->matricula }})
                    @else
                        <span class="text-danger">Vehículo no encontrado</span>
                    @endif
                </td>
                <td>
                    @if($invoice->repair)
                        {{ $invoice->repair->descripcion }}
                    @else
                        <span class="text-danger">Reparación no encontrada</span>
                    @endif
                </td>
                <td>{{ __('€') }}{{ number_format($invoice->monto, 2, ',', '.') }}</td>
                <td>{{ \Carbon\Carbon::parse($invoice->fecha)->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('mecanico.facturas.edit', $invoice->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <a href="{{ url('/facturas/'.$invoice->id.'/pdf') }}" class="btn btn-primary btn-sm">Generar Factura</a>

                    <form action="{{ route('mecanico.facturas.destroy', $invoice->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar esta factura?')">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
    {{ $invoices->links('pagination::bootstrap-5') }}
</div>
</div>
@endsection
