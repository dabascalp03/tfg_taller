@extends('layouts.app')

@section('title', 'Todas las Facturas')

@section('content')
<div class="container">
    <h2>Todas tus Facturas</h2>
    @if($facturas->isEmpty())
        <p>No hay facturas registradas.</p>
    @else
        <div class="row">
            @foreach($facturas as $factura)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">Factura #{{ $factura->id }}</div>
                        <div class="card-body">
                            <p>Fecha: {{ $factura->fecha_formateada }}</p>
                            <p>Pago: {{ $factura->monto }} €</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
