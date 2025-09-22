@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center fw-bold" >Detalles del Servicio</h1>
    <hr class="mx-auto" style="width: 320px; border-top: 3px solid #ff8000;">
    <h3 class="mb-4 mt-5 fw-bold text-center" style="color:#333;">Configura y solicita tu matrícula</h3>
    <hr class="mx-auto" style="width: 320px; border-top: 3px solid #ff8000;">

@if(session('success'))
<div class="alert fade show d-flex align-items-center justify-content-between px-4 py-3 mt-4 shadow-sm"
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
<div class="alert fade show px-4 py-3 mt-4 shadow-sm"
     role="alert"
     style="background-color: #fff0f0; border-left: 5px solid #dc3545; border-radius: 10px; color: #721c24;">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <i class="fas fa-exclamation-circle me-2" style="color: #dc3545;"></i>
            <strong>Hubo un problema al enviar el formulario:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <p class="mt-3 mb-0"><em>Consejo: verifica que el número de matrícula esté bien escrito y que hayas seleccionado una opción.</em></p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
</div>
@endif


    <form action="{{ route('matricula.enviar') }}" method="POST" class="mt-4">
        @csrf

        <div class="mb-4">
            <h5 class="fw-bold mb-3" ">Selecciona tu placa</h5>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius:14px;">
                        <img src="{{ asset('img/servicios/matricula.png') }}" class="card-img-top" alt="Matrícula Estándar" style="border-radius:14px 14px 0 0;object-fit:cover;max-height:120px;">
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold mb-1">Matrícula Acrílica Estándar</h6>
                            <p class="card-text small mb-2">Material resistente, flexible y duradero. 3 años de garantía.</p>
                            <p class="fw-bold mb-2" style="color:#ff8000;">16,99€</p>
                            <input type="radio" name="tipo_matricula" value="estandar" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius:14px;">
                        <img src="{{ asset('img/servicios/matricula.png') }}" class="card-img-top" alt="Matrícula Híbrida" style="border-radius:14px 14px 0 0;object-fit:cover;max-height:120px;">
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold mb-1">Matrícula Híbrida Coche</h6>
                            <p class="card-text small mb-2">Material ligero, reciclado y resistente. 3 años de garantía.</p>
                            <p class="fw-bold mb-2" style="color:#ff8000;">18,99€</p>
                            <input type="radio" name="tipo_matricula" value="hibrida" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0" style="border-radius:14px;">
                        <img src="{{ asset('img/servicios/matricula.png') }}" class="card-img-top" alt="Matrícula Alfa Romeo" style="border-radius:14px 14px 0 0;object-fit:cover;max-height:120px;">
                        <div class="card-body text-center">
                            <h6 class="card-title fw-bold mb-1">Matrícula Acrílica Alfa Romeo</h6>
                            <p class="card-text small mb-2">Específica para Alfa Romeo. Material resistente.</p>
                            <p class="fw-bold mb-2" style="color:#ff8000;">16,99€</p>
                            <input type="radio" name="tipo_matricula" value="alfa_romeo" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-4">
            <h5 class="fw-bold mb-2" >Personaliza tu placa</h5>
            <p class="text-muted small mb-2">Es indispensable presentar DNI del titular del vehículo y permiso de circulación en el centro para recoger el producto.</p>
            <label for="numero_matricula" class="form-label fw-bold">Introduce el número de matrícula</label>
            <input type="text" name="numero_matricula" id="numero_matricula" class="form-control" placeholder="1234 ABC" pattern="[A-Z0-9- ]{5,10}" required>
        </div>
        
        <div class="text-center">
            <button type="submit" class="btn btn-primary px-4 py-2 fw-bold" style="background:#ff8000;border:none;border-radius:25px;font-size:1.1rem;">
                Solicitar matrícula
            </button>
        </div>
    </form>
</div>

<style>
.btn-primary {
    background-color: #ff8000;
    border-color: #ff8000;
    color: #fff;
    font-weight: bold;
    border-radius: 25px;
    transition: background 0.2s, color 0.2s;
}
.btn-primary:hover {
    background-color: #e67e22;
    border-color: #e67e22;
    color: #fff;
}
.card-title {
    color: #222;
}
.card {
    transition: box-shadow 0.2s;
}
.card:hover {
    box-shadow: 0 4px 18px rgba(255,128,0,0.13);
}
</style>
@endsection








