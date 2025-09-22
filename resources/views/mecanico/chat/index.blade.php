@extends('layouts.mecanico')

@section('title', 'Chat para Mecánicos')

@section('content')
<div class="chat-container">
    <form method="GET" action="{{ route('mecanico.chat.index') }}">
        <label for="receptor">Selecciona un cliente:</label>
        <select name="receptor_id" id="receptor" class="form-select" onchange="this.form.submit()">
            <option value="" disabled selected>-- Elige un cliente --</option>
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

    <div id="chat-mensajes" class="mensajes-box">
        @foreach($mensajes as $mensaje)
            <div class="mensaje {{ $mensaje->emisor_id == auth()->id() ? 'text-end' : 'text-start' }}">
                <strong>{{ $mensaje->emisor->nombre }}</strong>: {{ $mensaje->mensaje }}
            </div>
        @endforeach
    </div>

    @if($receptor_id)
    <form id="form-chat">
        @csrf
        <input type="hidden" id="receptor_id" value="{{ $receptor_id }}">
        <textarea id="mensaje" class="form-control" placeholder="Escribe tu mensaje aquí..."></textarea>
        <button type="submit" class="btn btn-primary mt-2">Enviar</button>
    </form>
    @endif
</div>
@endsection

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
        background-color: #f9f9f9;
    }

    .mensaje.text-end {
        text-align: right;
        color: blue;
    }

    .mensaje.text-start {
        text-align: left;
        color: green;
    }
</style>
@endpush

@push('scripts')
<script>

document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('form-chat'); // Selecciona el formulario por su ID
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Evita que la página se recargue al enviar el formulario
            
            console.log('Evento submit capturado'); // Depuración para verificar que el evento funciona
            
            // Obtener los valores del formulario
            const mensaje = document.getElementById('mensaje').value.trim();
            const receptor_id = document.getElementById('receptor_id').value;

            if (!mensaje) {
                alert('Escribe un mensaje.'); // Validación básica
                return;
            }

            // Configurar y realizar la solicitud AJAX
            const data = {
                receptor_id: receptor_id,
                mensaje: mensaje,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Obtén el token CSRF
            };

            fetch('{{ route('mecanico.chat.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respuesta del servidor:', data); // Depuración
                
                // Limpiar el campo de texto del mensaje
                document.getElementById('mensaje').value = '';

                // Crear el nuevo mensaje y agregarlo al cuadro de chat
                const clase = data.mensaje.emisor_id == {{ auth()->id() }} ? 'text-end' : 'text-start';
const nuevoMensaje = `
    <div class="mensaje ${clase}">
        <strong>${data.mensaje.emisor_nombre}</strong>: ${data.mensaje.mensaje}
    </div>
`;

                document.getElementById('chat-mensajes').insertAdjacentHTML('beforeend', nuevoMensaje);

                // Desplazar el cuadro de mensajes hacia abajo
                document.getElementById('chat-mensajes').scrollTop = document.getElementById('chat-mensajes').scrollHeight;
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                alert('No se pudo enviar el mensaje.');
            });
        });
    } else {
        console.error('Formulario no encontrado en el DOM'); // Depuración si el formulario no existe
    }
});


function actualizarMensajesUsuarios() {
    fetch('{{ route('mecanico.chat.noLeidosPorUsuario') }}')
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
setInterval(actualizarMensajesUsuarios, 10000);




</script>
@endpush
