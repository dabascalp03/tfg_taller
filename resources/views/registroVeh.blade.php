@extends('layouts.app')

@section('title', 'TodoMotor - Registro de Vehículo')
@section('content')

<section class="container my-5">
    <div class="text-center mb-4">
        <h2 class="fw-bold">Registra tu Vehículo</h2>
        <hr class="mx-auto" style="width: 320px; border-top: 3px solid #ff8000;">
        <p class="lead mb-0" style="color:#555;">Completa el formulario para añadir tu vehículo a tu perfil y acceder a todos los servicios.</p>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            @auth
                <div class="card shadow-sm border-0 mb-4" style="border-radius:18px;">
                    <div class="card-body p-4">

                        {{-- ALERTAS --}}
                        @if(session('success'))
                        <div class="alert fade show d-flex align-items-center justify-content-between px-4 py-3 mb-4 shadow-sm"
                             role="alert"
                             style="background-color: #fff4e6; border-left: 5px solid #ff8000; border-radius: 10px; color: #6c3900;">
                            <div>
                                <i class="fas fa-check-circle me-2" style="color: #ff8000;"></i>
                                {{ session('success') }}
                            </div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                        </div>
                        @endif

                        @if($errors->any())
                        <div class="alert fade show px-4 py-3 mb-4 shadow-sm"
                             role="alert"
                             style="background-color: #fff0f0; border-left: 5px solid #dc3545; border-radius: 10px; color: #721c24;">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <i class="fas fa-exclamation-circle me-2" style="color: #dc3545;"></i>
                                    <strong>Por favor corrige los errores:</strong>
                                    <ul class="mb-0 mt-2 ps-3">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
                            </div>
                        </div>
                        @endif
                        {{-- FIN ALERTAS --}}

                        @include('partials.form_registro_vehiculo')

                    </div>
                </div>
            @else
                <div class="alert alert-warning text-center mt-4" style="font-size:1.1rem;">
                    Para registrar tu vehículo, <a href="{{ route('login') }}" class="fw-bold" style="color:#ff8000;">inicia sesión</a>.
                </div>
            @endauth
        </div>
    </div>
</section>

@endsection
