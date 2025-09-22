@extends('layouts.app')

@section('title', 'TodoMotor - Chat')

@push('styles')
<style>
    .chat-container {
        max-width: 600px;
        margin: auto;
    }

    .mensajes-box {
        height: 300px;
        overflow-y: scroll;
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 10px;
        background-color: #eef5ff; /* Cambiado para un color relacionado con servicios técnicos */
    }

    .mensaje {
        margin-bottom: 10px;
    }

    .mensaje.text-end {
        text-align: right;
        color: darkblue; /* Color ajustado para mecánicos */
    }

    .mensaje.text-start {
        text-align: left;
        color: darkgreen; /* Color ajustado para mecánicos */
    }
</style>
@endpush

@section('title', 'TodoMotor - Chat con Mecánicos')


@section('content')
    <h2 class="text-center fw-bold">Chat con Mecánicos</h2>
    <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">
<div class="chat-container">
    <!-- Select para elegir receptor -->
    <form method="GET" action="{{ route('chat.index') }}">
        <label for="receptor">Selecciona un mecánico:</label>
        <select name="receptor_id" id="receptor" class="form-select" onchange="this.form.submit()">
                <option value="" disabled selected>-- Elige mecánico --</option>
                @foreach($receptores as $receptor)
                    <option value="{{ $receptor->id }}" {{ $receptor_id == $receptor->id ? 'selected' : '' }}>
                        {{ $receptor->nombre }}
                        @if($receptor->mensajes_no_leidos > 0)
                            ({{ $receptor->mensajes_no_leidos }}) 🔴
                        @endif
                    </option>
                @endforeach
            </select>

    </form>

    <!-- Mensajes -->
    <div id="chat-mensajes" class="mensajes-box">
        @foreach($mensajes as $mensaje)
            <div class="mensaje {{ $mensaje->emisor_id == auth()->id() ? 'text-end' : 'text-start' }}">
                <strong>{{ $mensaje->emisor->nombre }}</strong>: {{ $mensaje->mensaje }}
            </div>
        @endforeach
    </div>

    <!-- Formulario de envío -->
    @if($receptor_id)
        <form id="form-chat">
            @csrf
            <input type="hidden" id="receptor_id" value="{{ $receptor_id }}">
            <textarea id="mensaje" class="form-control" placeholder="Describe el problema técnico..." rows="3"></textarea>
            <button type="submit" class="btn btn-primary mt-2">Enviar</button>
        </form>
    @endif
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function () {
    // Manejar envío del mensaje
    $('#form-chat').submit(function (e) {
        e.preventDefault(); // Evitar la recarga de la página

        var mensaje = $('#mensaje').val().trim(); // Capturar el contenido del mensaje
        var receptor_id = $('#receptor_id').val(); // Capturar el receptor del mensaje

        if (!mensaje) {
            alert('Por favor, escribe un mensaje.'); // Validación básica
            return;
        }

        // Realizar solicitud AJAX para guardar el mensaje
        $.ajax({
            url: '{{ route('chat.store') }}', // Usar la ruta para mecánicos
            method: 'POST',
            data: {
                receptor_id: receptor_id,
                mensaje: mensaje,
                _token: '{{ csrf_token() }}', // Token CSRF obligatorio
            },
            success: function (response) {
                // Limpiar el campo de texto
                $('#mensaje').val('');

                // Agregar el nuevo mensaje al cuadro de mensajes
                var clase = response.mensaje.emisor_id == {{ auth()->id() }} ? 'text-end' : 'text-start';
                var nuevoMensaje = `
                    <div class="mensaje ${clase}">
                        <strong>${response.mensaje.emisor_id}</strong>: ${response.mensaje.mensaje}
                    </div>
                `;
                $('#chat-mensajes').append(nuevoMensaje);

                // Desplazar el cuadro de mensajes hacia abajo
                $('#chat-mensajes').scrollTop($('#chat-mensajes').prop('scrollHeight'));
            },
            error: function (xhr) {
                console.error(xhr.responseText); // Depurar en consola
                alert(xhr.responseJSON?.error || 'Error al enviar el mensaje.');
            }
        });
    });
});



    function actualizarMensajesUsuarios() {
        fetch('{{ route('chat.noLeidosPorMecanico') }}')
            .then(response => response.json())
            .then(data => {
                data.forEach(usuario => {
                    let option = document.querySelector(`#receptor option[value='${usuario.id}']`);
                    if (option) {
                        option.innerText = usuario.nombre + (usuario.noLeidos > 0 ? ` (${usuario.noLeidos}) 🔴` : '');
                    }
                });
            });
    }

    // Ejecutar cada 10 segundos
    setInterval(actualizarMensajesUsuarios, 4000);


</script>
@endpush
