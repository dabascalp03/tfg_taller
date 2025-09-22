@extends('layouts.app')

@section('title', 'TodoMotor - ¿Quienes Somos?')

@section('content')
<div class="container py-5">
    <!-- Sección ¿Quiénes somos? -->
    <section class="mb-5">
        <div class="text-center mb-4">
            <h1 class="fw-bold">¿Quiénes somos?</h1>
            <p class="text-muted">Conoce más sobre TodoMotor y nuestro compromiso con la excelencia automotriz.</p>
            <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <h4 class="fw-bold">Nuestra misión</h4>
                <p>En TodoMotor, trabajamos día a día para ofrecerte los mejores servicios y soluciones automotrices. Nuestro equipo altamente capacitado está comprometido con la calidad y la satisfacción de nuestros clientes.</p>
                <h4 class="fw-bold mt-4">Nuestros valores</h4>
                <ul class="list-unstyled">
                    <li><i class="fas fa-check-circle" style="color:#ff8000"></i> Compromiso con la calidad</li>
                    <li><i class="fas fa-check-circle" style="color:#ff8000"></i> Innovación constante</li>
                    <li><i class="fas fa-check-circle" style="color:#ff8000"></i> Atención personalizada</li>
                </ul>
            </div>
            <div class="col-md-6">
                <!-- Google Maps -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2902.6748986967696!2d-3.855964123977651!3d43.32106457111977!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd4931a267f8abc1%3A0xcd662232e647bd05!2sTodo%20motor!5e0!3m2!1ses!2sit!4v1742920227686!5m2!1ses!2sit" 
                    width="100%" 
                    height="350" 
                    style="border: 2px solid #ff8000; border-radius: 8px;" 
                    allowfullscreen="" 
                    loading="lazy"></iframe>
        </div>
</section>
</div>
@endsection
