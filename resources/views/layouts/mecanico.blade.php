<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Panel Mecánicos')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/TDM.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #222;
            height: 120vh;
            padding: 20px 20px 10px; /* Adjusted padding to reduce bottom space */
            color: white;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 5px; /* Reduced margin to bring links closer */
        }
        .sidebar a:hover {
            background-color: #ff8000;
            color: black;
        }
        .active {
            background-color: #ff8000;
        }
        .logo img {
            width: 200px;
            display: block;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
        <div class="logo text-center mb-4">
        <img src="{{ asset('img/todoMotorB.png') }}" alt="Logo de la Empresa">
    </div>
    <a href="{{ route('mecanico.dashboard') }}" class="{{ request()->routeIs('mecanico.dashboard') ? 'active' : '' }}">Dashboard Mecánicos</a>
    <a href="{{ route('mecanico.vehicles.index') }}" class="{{ request()->routeIs('mecanico.vehicles.index') ? 'active' : '' }}">Vehículos</a>
    <a href="{{ route('mecanico.reparaciones.index') }}" class="{{ request()->routeIs('mecanico.reparaciones.index') ? 'active' : '' }}">Reparaciones</a>
            <a href="{{ route('mecanico.facturas.index') }}" class="{{ request()->routeIs('mecanico.facturas.index') ? 'active' : '' }}">Facturas</a>
            <a href="{{ route('mecanico.chat.index') }}" class="{{ request()->routeIs('mecanico.chat.index') ? 'active' : '' }}">
    Chat <span id="contador-mensajes" class="badge bg-danger"></span>
</a>
            <a href="{{ route('mecanico.solicitudes.index') }}" class="{{ request()->routeIs('mecanico.solicitudes.index') ? 'active' : '' }}">Solicitudes Vehículos</a>
            <a href="{{ route('mecanico.matriculas.index') }}" class="{{ request()->routeIs('mecanico.matriculas.index') ? 'active' : '' }}">Solicitudes Matrículas</a>
            <a href="{{ route('mecanico.blog.index') }}" class="{{ request()->routeIs('mecanico.blog.index') ? 'active' : '' }}">Blog</a>
            <a href="{{ route('mecanico.restauraciones.index') }}" class="{{ request()->routeIs('mecanico.restauraciones.index') ? 'active' : '' }}">Restauraciones</a>
            <a href="{{ route('mecanico.ofertas.index') }}" class="{{ request()->routeIs('mecanico.ofertas.index') ? 'active' : '' }}">Ofertas</a>
            <a href="{{ route('mecanico.citas.index') }}" class="{{ request()->routeIs('mecanico.citas.index') ? 'active' : '' }}">Citas</a>

        </div>

        <!-- Contenido principal -->
        <div class="flex-grow-1">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <span class="navbar-brand"></span>
                    <div class="d-flex">
                        <span class="navbar-text me-3">Hola, {{ auth()->user()->nombre ?? 'Usuario' }}</span>
                        <a href="{{ route('index') }}" class="btn btn-danger " id="logout-link">

                        <script>
                            document.getElementById('logout-link').addEventListener('click', function(e) {
                                e.preventDefault(); // Prevenir el comportamiento por defecto del enlace

                                // Crear un formulario de manera dinámica
                                var form = document.createElement('form');
                                form.method = 'POST';
                                form.action = '{{ route('logout') }}';

                                // Agregar el token CSRF al formulario
                                var csrfToken = document.createElement('input');
                                csrfToken.type = 'hidden';
                                csrfToken.name = '_token';
                                csrfToken.value = '{{ csrf_token() }}';
                                form.appendChild(csrfToken);

                                // Enviar el formulario
                                document.body.appendChild(form);
                                form.submit();
                            });


    function actualizarMensajesNoLeidos() {
        fetch('{{ route('mecanico.chat.noLeidos') }}')
            .then(response => response.json())
            .then(data => {
                document.getElementById('contador-mensajes').innerText = data.noLeidos > 0 ? data.noLeidos : '';
            })
            .catch(error => console.error('Error al cargar los mensajes no leídos:', error));
    }

    // Ejecutar la actualización cada 5 segundos
    setInterval(actualizarMensajesNoLeidos, 5000);

    // Cargar el número de mensajes al iniciar
    actualizarMensajesNoLeidos();
                        </script>



            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </a>
                    </div>
                </div>
            </nav>

            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>
    @stack('scripts')

</body>
</html>
