@extends('layouts.app')

@section('title', 'TodoMotor - Servicios')

@section('content')
    <div class="container">
        <h1 class="text-center"><b>Detalles del Servicio</b></h1>
        <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">
        <div id="service-content">
            @include("servicios.partials.$service")
        </div>
    </div>
@endsection





