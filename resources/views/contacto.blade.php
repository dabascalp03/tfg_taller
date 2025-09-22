
@extends('layouts.app')

@section('title', 'TodoMotor - Contacto')

@section('content')
<div class="container py-5">
<section>
        <div class="text-center mb-4">
            <h1 class="fw-bold">Contáctanos</h1>
            <p class="text-muted">Estamos aquí para ayudarte. Ponte en contacto con nosotros para cualquier consulta.</p>
            <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">
        </div>
        <div class="row">
            <!-- Información de contacto -->
            <div class="col-md-6 mb-4">
                <div class="bg-light p-4 rounded shadow-sm">
                    <h4 class="fw-bold mb-3">Nuestra información</h4>
                    <p><i class="fas fa-phone" style="color:#ff8000"></i> <strong>Teléfono:</strong> <a href="tel:+34900000000" class="text-dark text-decoration-none">+34 942 51 78 49</a></p>
                    <p><i class="fas fa-envelope" style="color:#ff8000"></i> <strong>Email:</strong> <a href="mailto:info@todomotor.com" class="text-dark text-decoration-none">info@todomotor.com</a></p>
                    <p><i class="fas fa-map-marker-alt" style="color:#ff8000"></i> <strong>Dirección:</strong> Calle La Frontera 22, Sarón, Cantabria</p>
                </div>
            </div>

            <!-- Formulario de contacto -->
            <div class="col-md-6">
            <form action="{{ route('contacto.enviar') }}" method="POST" class="p-4 bg-light rounded shadow-sm">
                @csrf
                    <h4 class="fw-bold mb-4">Envíanos un mensaje</h4>
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Tu nombre completo" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Tu correo electrónico" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="message" name="message" rows="5" placeholder="Escribe tu mensaje" required></textarea>
                    </div>
                    <button type="submit" class="btn w-100" style="background-color:#ff8000">Enviar mensaje</button>
                </form>
            </div>
        </div>
    </section>
    </div>
@endsection