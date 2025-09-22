@extends('layouts.app')

@section('title', 'Política de Cookies - TodoMotor')

@section('content')
<div class="container my-5">
    <h2 class="text-center fw-bold mb-3" style="color:#ff8000;">Política de Cookies</h2>
    <hr class="mx-auto" style="width: 320px; border-top: 3px solid #ff8000;">
    <div class="bg-white p-4 rounded shadow-sm">
        <p>
            En <strong>TodoMotor</strong> utilizamos cookies propias y de terceros para mejorar tu experiencia de usuario, analizar la navegación y ofrecerte contenidos adaptados a tus intereses.
        </p>
        <h4 class="mt-4 fw-bold" style="color:#ff8000;">¿Qué son las cookies?</h4>
        <p>
            Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas una página web. Sirven para recordar tus preferencias, facilitar la navegación y recopilar información estadística anónima.
        </p>
        <h4 class="mt-4 fw-bold" style="color:#ff8000;">¿Qué tipos de cookies utilizamos?</h4>
        <ul>
            <li><strong>Cookies técnicas:</strong> Necesarias para el funcionamiento básico del sitio y la seguridad.</li>
            <li><strong>Cookies de personalización:</strong> Permiten recordar tus preferencias (idioma, región, etc.).</li>
            <li><strong>Cookies de análisis:</strong> Nos ayudan a entender cómo usas nuestra web y mejorarla (por ejemplo, Google Analytics).</li>
            <li><strong>Cookies de terceros:</strong> Algunas funciones pueden usar servicios externos que instalan sus propias cookies (por ejemplo, vídeos, mapas, redes sociales).</li>
        </ul>
        <h4 class="mt-4 fw-bold" style="color:#ff8000;">¿Cómo puedes gestionar las cookies?</h4>
        <p>
            Puedes aceptar, rechazar o configurar el uso de cookies a través del aviso que aparece al entrar en la web. Además, puedes eliminar o bloquear las cookies desde la configuración de tu navegador. Ten en cuenta que bloquear algunas cookies puede afectar al funcionamiento de la web.
        </p>
        <h4 class="mt-4 fw-bold" style="color:#ff8000;">Más información</h4>
        <p>
            Si tienes dudas sobre nuestra política de cookies, puedes contactar con nosotros en <a href="mailto:utodomotor@gmail.com">utodomotor@gmail.com</a>.
        </p>
        <a href="{{ url('/') }}" class="btn btn-primary mt-3" style="background:#ff8000;border:none;">Volver al inicio</a>
    </div>
</div>
@endsection
