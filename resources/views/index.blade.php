@extends('layouts.app')

@section('title', 'TodoMotor - Inicio')


@push('styles')
<link rel="stylesheet" href="{{ asset('css/index.css') }}">
<style>
    .parallax-section {
    background-image: url('{{ asset('img/fondoOfertas2.jpg') }}');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    padding: 100px 0;
    position: relative;
    width: 100%;
    margin: 0;
    height: auto;
}

@media screen and (max-width: 768px) {
    .parallax-section {
        height: auto;
    }

    .offer-gen {
        margin-bottom: 20px;
    }
    
}
</style>
@endpush


@section('content')
    <!-- Sección de Ofertas con Parallax -->
    <section class="container-fluid parallax-section text-center mb-5">
        <div class="parallax-overlay"></div>
        <h2 class="mb-4 section-title text-light fw-bold position-relative">Ofertas Especiales</h2>
        <div id="offerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        @foreach ($ofertas as $index => $grupo)
        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
            <div class="row justify-content-center">
                @foreach ($grupo as $oferta)
                <div class="offer-gen col-md-4 d-flex">
                    <div class="offer-card shadow-lg p-3 mb-5 rounded w-200">
                    <img src="{{ Storage::url($oferta->imagen) }}" alt="{{ $oferta->titulo }}" class="img-fluid rounded">
                    <h4 class="offer-title mt-3 text-dark fw-bold">{{ $oferta->titulo }}</h4>
                        <p class="offer-description text-muted">{{ $oferta->descripcion }}</p>
                        <span class="offer-validity badge text-dark">Válido hasta: {{ $oferta->fecha_expedicion->format('d-m-Y') }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#offerCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#offerCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
    </button>
</div>

    </section>

    <!-- Sección de Servicios -->
    <section class="container text-center py-5 bg-light">
        <h2 class="mb-4 section-title fw-bold">Nuestros Servicios</h2>
        <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">
        
        <div class="row justify-content-center">
            @foreach ([
                ['aceites', 'mantenimiento.png', 'Aceites y Revisiones'],
                ['frenado', 'frenado.png', 'Frenado'],
                ['climatizacion', 'climatizacion.png', 'Climatización'],
                ['amortiguadores', 'amortiguacion.png', 'Amortiguadores'],
                ['matriculas', 'matriculacion.png', 'Matrículas']
            ] as $servicio)
            <div class="col-md-2 col-6 mb-4">
                <a href="{{ url('/servicios?service=' . $servicio[0]) }}" class="service-link d-block text-decoration-none">
                    <div class="service-card p-3 shadow-sm rounded bg-white">
                        <img src="{{ asset('img/icons/' . $servicio[1]) }}" alt="{{ $servicio[2] }}" class="img-fluid" width="80">
                        <p class="service-text mt-2 text-dark">{{ $servicio[2] }}</p>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>



@endsection










