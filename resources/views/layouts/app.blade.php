<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Metadatos esenciales -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Gestión y servicios automotrices con TodoMotor">
    <meta name="author" content="TodoMotor">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="css/applay.css">

    <title>@yield('title', 'TodoMotor')</title>

    <!-- Estilos: Bootstrap y CSS personalizado -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('img/TDM.png') }}">


    <!-- JQuery para funciones dinámicas -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- FullCalendar -->
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js'></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/scratchcard-js"></script>
    @stack('styles')
</head>

<body>
    <!-- Navbar estilizado -->
    <header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg shadow custom-navbar">
        <div class="container-fluid px-5">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('img/TodoMotorReducido.png') }}" alt="Logo TodoMotor" width="140" class="img-fluid">
            </a>

            <!-- Botón para pantallas pequeñas -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Menú con tus enlaces originales -->
            <div class="collapse navbar-collapse justify-content-between" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Dropdown de Servicios -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle fw-semibold px-3 py-2 rounded-pill" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" style="transition:background 0.18s;">
                            <i class="fas fa-tools me-1"></i> Servicios
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ url('/servicios?service=aceites') }}"><i class="fas fa-oil-can me-2"></i> Aceites y Revisiones</a></li>
                            <li><a class="dropdown-item" href="{{ url('/servicios?service=frenado') }}"><i class="fas fa-car-crash me-2"></i> Frenado</a></li>
                            <li><a class="dropdown-item" href="{{ url('/servicios?service=climatizacion') }}"><i class="fas fa-snowflake me-2"></i> Climatización</a></li>
                            <li><a class="dropdown-item" href="{{ url('/servicios?service=amortiguadores') }}"><i class="fas fa-car-side me-2"></i> Amortiguadores</a></li>
                            <li><a class="dropdown-item" href="{{ url('/servicios?service=matriculas') }}"><i class="fas fa-id-card me-2"></i> Matrículas</a></li>
                        </ul>
                    </li>

                    <!-- Restauraciones -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold px-3 py-2 rounded-pill" href="{{ url('/restauraciones') }}" style="transition:background 0.18s;">
                            <i class="fas fa-car me-1"></i> Proyectos
                        </a>
                    </li>
                    @if(Auth::check())
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3 py-2 rounded-pill" href="{{ url('/registroVehiculo') }}" style="transition:background 0.18s;">
                                <i class="fas fa-plus-circle me-1"></i> Registro Vehículo
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-semibold px-3 py-2 rounded-pill" href="{{ url('/citas') }}" style="transition:background 0.18s;">
                                <i class="fas fa-calendar-check me-1"></i> Coge Cita
                            </a>
                        </li>
                    @endif

                    <!-- Blog -->
                    <li class="nav-item">
                        <a class="nav-link fw-semibold px-3 py-2 rounded-pill" href="{{ url('/blog') }}" style="transition:background 0.18s;">
                            <i class="fas fa-blog me-1"></i> Blog
                        </a>
                    </li>

                    @if(Auth::check())
                    <li class="nav-item">
                        <a class="nav-link fw-semibold px-3 py-2 rounded-pill d-flex align-items-center" href="{{ url('/chat') }}" style="transition:background 0.18s; position:relative;">
                            <i class="fas fa-comments me-1"></i> Chat
                            <span id="contador-mensajes" class="badge bg-warning text-dark ms-2"
                                  style="background-color:#ff8000 !important; color:#fff !important; font-size:0.78rem; padding:2px 7px; position:relative; top:-2px; min-width:18px; min-height:18px; display:inline-flex; align-items:center; justify-content:center;">
                            </span>
                        </a>
                    </li>
                    @endif
                </ul>





                <!-- Contenido dinámico del header -->
                <div id="header-content" class="d-flex align-items-center">
                    <p class="text-light small mb-0">Cargando...</p>
                </div>
            </div>
        </div>
    </nav>
</header>
<style>
    .navbar-nav .nav-link {
        transition: color 0.18s;
        margin-right: 0.3rem;
        font-weight: 500;
        border-radius: 18px;
        position: relative;
        z-index: 1;
        overflow: hidden;
    }
    .navbar-nav .nav-link:hover,
    .navbar-nav .nav-link.active,
    .navbar-nav .show > .nav-link {
        color: #ff8000 !important;
        background: transparent !important;
        box-shadow: none !important;
        text-shadow: none !important;
    }
    .navbar-nav .dropdown-menu .dropdown-item:hover {
        background: #ff8000 !important;
        color: #fff !important;
    }
    .navbar-nav .dropdown-menu .dropdown-item i {
        color: #ff8000;
        margin-right: 0.3rem;
    }
    #contador-mensajes {
        font-size: 0.78rem !important;
        padding: 2px 7px !important;
        min-width: 18px;
        min-height: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1;
    }
    @media (max-width: 991px) {
        .navbar-nav .nav-link {
            margin-bottom: 0.5rem;
            width: 100%;
            text-align: left;
        }
    }
</style>


    <!-- Contenido principal -->
    <div class="container mt-4">
        @yield('content')
    </div>


    <footer class="bg-dark text-white py-5">
    <div class="container">
        <div class="row text-center">
            <!-- Sección de contacto y redes sociales -->
            <div class="col-md-4">
                <h5 class="text-uppercase fw-bold mb-3">¡Conéctate con nosotros!</h5>
                <!-- Redes sociales -->
                <div class="mb-3">
                        <i class="fab fa-instagram fa-2x me-3"></i>
                        <i class="fab fa-facebook fa-2x"></i>
                </div>
                <!-- Información de contacto -->
                <p class="mb-1"><i class="fas fa-envelope me-2"></i><a href="mailto:utodomotor@gmail.com" class="text-white text-decoration-none">info@todomotor.com</a></p>
                <p><i class="fas fa-phone me-2"></i><a href="tel:+34942517849" class="text-white text-decoration-none">942 51 78 49</a></p>
            </div>

            <!-- Menú de servicios -->
            <div class="col-md-4">
                <h5 class="text-uppercase fw-bold mb-3">Servicios</h5>
                <div class="dropdown">
                    <button class="btn btn-outline-light dropdown-toggle" type="button" id="servicesDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Explora nuestros servicios
                    </button>
                    <ul class="dropdown-menu bg-dark text-white text-center" aria-labelledby="servicesDropdown">
                        <li><a class="dropdown-item text-white" href="{{ url('/servicios?service=aceites') }}">Aceites y Revisiones</a></li>
                        <li><a class="dropdown-item text-white" href="{{ url('/servicios?service=frenado') }}">Frenado</a></li>
                        <li><a class="dropdown-item text-white" href="{{ url('/servicios?service=climatizacion') }}">Climatización</a></li>
                        <li><a class="dropdown-item text-white" href="{{ url('/servicios?service=amortiguadores') }}">Amortiguadores</a></li>
                        <li><a class="dropdown-item text-white" href="{{ url('/servicios?service=matriculas') }}">Matrículas</a></li>
                    </ul>
                </div>
            </div>

            <!-- Enlaces principales -->
            <div class="col-md-4">
                <h5 class="text-uppercase fw-bold mb-3">Enlaces</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ url('/') }}" class="text-white text-decoration-none d-block">Inicio</a></li>
                    <li><a href="{{ url('/restauraciones') }}" class="text-white text-decoration-none d-block">Restauraciones</a></li>
                    <a href="{{ url('/contacto') }}" class="text-white text-decoration-none d-block">Contacto</a>
                    <li><a href="{{ url('/quienes-somos') }}" class="text-white text-decoration-none">¿Quiénes somos?</a></li>
                </ul>
            </div>
        </div>

        <!-- Línea divisoria -->
        <hr class="border-secondary">

        <!-- Derechos reservados -->
        <div class="text-center">
            <p class="mb-0">&copy; {{ date('Y') }} TodoMotor. Todos los derechos reservados.</p>
            <p class="small">Desarrollado con ❤️ por TodoMotor.</p>
        </div>
    </div>
</footer>

<!-- Estilos personalizados -->
<style>
    footer {
        background-image: url('../img/fondoHF.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        height: auto;
        margin-top: 50px;
    }
    footer i {
        transition: transform 0.3s ease, color 0.3s ease;
    }
    footer i:hover {
        transform: scale(1.2);
        color: #ff8000;
    }
    .dropdown-menu {
        background-color: #222;
        border-radius: 8px;
        border: 1px solid #444;
    }
    .dropdown-menu .dropdown-item:hover {
        background-color: #ff8000;
        color: #000 !important;
    }
    footer a:hover {
        color: #ff8000;
    }
    #contador-mensajes {
        background-color: #ff8000 !important;
        color: #fff !important;
    }
    /* Responsive footer and navbar */
    @media (max-width: 767px) {
        .navbar .container-fluid.px-5 {
            padding-left: 0.7rem !important;
            padding-right: 0.7rem !important;
        }
        .navbar-brand img {
            width: 100px !important;
        }
        .navbar .nav-link {
            font-size: 0.98rem !important;
        }
        .navbar .dropdown-menu {
            font-size: 0.95rem !important;
        }
        footer .container {
            padding-left: 0.5rem !important;
            padding-right: 0.5rem !important;
        }
        footer .row > div {
            margin-bottom: 1.2rem;
        }
        footer .col-md-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
        footer h5 {
            font-size: 1.01rem !important;
        }
        footer .dropdown-menu {
            font-size: 0.95rem !important;
        }
        footer .list-unstyled {
            font-size: 0.95rem !important;
        }
        .bg-dark, footer.bg-dark {
            padding-left: 0.3rem !important;
            padding-right: 0.3rem !important;
        }
    }
    /* Cookie banner responsive */
    #cookie-banner {
        animation: fadeInCookies 0.7s;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        letter-spacing: 0.01em;
        /* Separación extra del borde inferior */
        bottom: 24px !important;
    }
    @keyframes fadeInCookies {
        from { opacity: 0; transform: translateY(60px);}
        to { opacity: 1; transform: translateY(0);}
    }
    #accept-cookies:hover {
        background: #e67e22 !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(255,128,0,0.13);
    }
    #cookie-banner a {
        color: #ff8000 !important;
        font-weight: 500;
        text-decoration: underline;
    }
    #cookie-banner a:hover {
        color: #e67e22 !important;
        text-decoration: underline;
    }
    @media (max-width: 600px) {
        #cookie-banner .mx-auto {
            max-width: 98vw !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        #cookie-banner .shadow-lg {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 0.7rem !important;
            padding: 1rem 0.3rem !important;
        }
        #cookie-banner .d-flex.align-items-center.gap-2.flex-grow-1 {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0.2rem !important;
        }
        #cookie-banner .fw-bold {
            font-size: 0.99rem !important;
        }
        #cookie-banner .small {
            font-size: 0.93rem !important;
        }
        #accept-cookies {
            width: 100%;
            margin-left: 0 !important;
            margin-top: 0.5rem !important;
            font-size: 1rem !important;
            padding: 0.7rem 0 !important;
        }
        #cookie-banner span[style*="font-size:2rem"] {
            font-size: 1.4rem !important;
        }
    }
</style>


    <!-- Scripts necesarios -->
    @stack('scripts')
    <script>
        $(document).ready(function () {
            // Función para cargar dinámicamente el estado del header
            function cargarHeader() {
                $.ajax({
                    url: "{{ route('header.status') }}",
                    method: "GET",
                    success: function (response) {
                        $("#header-content").html(response);
                    },
                    error: function () {
                        $("#header-content").html('<p class="text-light small">Error al cargar</p>');
                    }
                });
            }

            cargarHeader(); // Inicializar carga dinámica del header

            // Manejo del cierre de sesión
            $(document).on('submit', '#logout-form', function (e) {
                e.preventDefault();
                $.post("{{ route('logout') }}", $(this).serialize(), function () {
                    cargarHeader(); // Recargar el estado del header
                });
            });
        });



    function actualizarMensajesNoLeidos() {
        fetch('{{ route('usuario.chat.noLeidos') }}')
            .then(response => response.json())
            .then(function(data) {
                var badge = document.getElementById('contador-mensajes');
                if (badge) {
                    if (data.noLeidos > 0) {
                        badge.innerText = data.noLeidos;
                        badge.style.display = 'inline-flex';
                    } else {
                        badge.innerText = '';
                        badge.style.display = 'none';
                    }
                }
            })
            .catch(function(error) {
                console.error('Error al cargar los mensajes no leídos:', error);
            });
    }

    // Ejecutar la actualización cada 5 segundos
    setInterval(actualizarMensajesNoLeidos, 5000);

    // Cargar el número de mensajes al iniciar
    actualizarMensajesNoLeidos();

    // Aviso de cookies
    document.addEventListener('DOMContentLoaded', function() {
        if (!localStorage.getItem('cookiesAccepted')) {
            var banner = document.getElementById('cookie-banner');
            if (banner) banner.style.display = 'block';
        }
        var btn = document.getElementById('accept-cookies');
        if (btn) {
            btn.onclick = function() {
                localStorage.setItem('cookiesAccepted', '1');
                var banner = document.getElementById('cookie-banner');
                if (banner) banner.style.display = 'none';
            };
        }
    });

    </script>

<!-- Aviso de cookies moderno y visual -->
<div id="cookie-banner" style="display:none; position:fixed; bottom:24px; left:0; right:0; z-index:9999; pointer-events:none;">
    <div class="mx-auto" style="max-width:420px;">
        <div class="shadow-lg rounded-4 px-4 py-3 d-flex flex-column flex-md-row align-items-center gap-3"
             style="background:rgba(255,255,255,0.97); border:2px solid #ff8000; pointer-events:auto;">
            <div class="d-flex align-items-center gap-2 flex-grow-1">
                <span style="font-size:2rem; color:#ff8000;"><i class="fas fa-cookie-bite"></i></span>
                <div>
                    <span class="fw-bold" style="color:#ff8000;">¡Cookies para una mejor experiencia!</span>
                    <div class="small text-muted mt-1">
                        Usamos cookies propias y de terceros para analizar el uso y personalizar el contenido.
                        <a href="{{ url('/politica-cookies') }}" class="ms-1" style="color:#ff8000;text-decoration:underline;font-weight:500;">Saber más</a>
                    </div>
                </div>
            </div>
            <button id="accept-cookies"
                class="btn btn-sm px-4 fw-bold shadow"
                style="background:#ff8000; color:#fff; border:none; border-radius:18px; font-size:1.08rem; transition:background 0.2s;">
                Aceptar
            </button>
        </div>
    </div>
</div>

<style>
    #cookie-banner {
        animation: fadeInCookies 0.7s;
        font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        letter-spacing: 0.01em;
        /* Separación extra del borde inferior */
        bottom: 24px !important;
    }
    @keyframes fadeInCookies {
        from { opacity: 0; transform: translateY(60px);}
        to { opacity: 1; transform: translateY(0);}
    }
    #accept-cookies:hover {
        background: #e67e22 !important;
        color: #fff !important;
        box-shadow: 0 4px 16px rgba(255,128,0,0.13);
    }
    #cookie-banner a {
        color: #ff8000 !important;
        font-weight: 500;
        text-decoration: underline;
    }
    #cookie-banner a:hover {
        color: #e67e22 !important;
        text-decoration: underline;
    }
    @media (max-width: 600px) {
        #cookie-banner .mx-auto {
            max-width: 98vw !important;
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
        #cookie-banner .shadow-lg {
            flex-direction: column !important;
            align-items: stretch !important;
            gap: 0.7rem !important;
            padding: 1rem 0.3rem !important;
        }
        #cookie-banner .d-flex.align-items-center.gap-2.flex-grow-1 {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 0.2rem !important;
        }
        #cookie-banner .fw-bold {
            font-size: 0.99rem !important;
        }
        #cookie-banner .small {
            font-size: 0.93rem !important;
        }
        #accept-cookies {
            width: 100%;
            margin-left: 0 !important;
            margin-top: 0.5rem !important;
            font-size: 1rem !important;
            padding: 0.7rem 0 !important;
        }
        #cookie-banner span[style*="font-size:2rem"] {
            font-size: 1.4rem !important;
        }
    }
</style>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
