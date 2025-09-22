<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoMotor - Administración</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Incluyendo Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ asset('img/TDM.png') }}">
    
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.17/index.global.min.js"></script>


    <link rel="stylesheet" href="{{ asset('css/layoutAdmin.css') }}">

    @stack('styles')

</head>
<body>

    <!-- Contenedor principal -->
    <div class="container-fluid">
        <div class="row">

            <!-- Menú lateral -->
            <nav class="col-md-3 col-lg-2 sidebar">
    <div class="logo text-center ">
        <img src="{{ asset('img/todoMotorB.png') }}" alt="Logo de la Empresa">
    </div>
    <span class="navbar-text text-white pl-2 me-3">Hola, {{ auth()->user()->nombre ?? 'Usuario' }}</span>

    <div class="list-group">
        <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-tachometer-alt"></i> Dashboard
        </a>
        <a href="{{ route('admin.users.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-users"></i> Usuarios
        </a>
        <a href="{{ route('admin.roles.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-user-shield"></i> Roles
        </a>
        <a href="{{ route('admin.vehicles.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-car"></i> Vehículos
        </a>
        <a href="{{ route('admin.repairs.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="bi bi-tools"></i> Reparaciones
        </a>
        <a href="{{ route('admin.invoices.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-file-invoice"></i> Facturas
        </a>
        <a href="{{ route('admin.solicitudes.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-clipboard-list"></i> Solicitudes Vehiculos
        </a>
        <a href="{{ route('admin.matriculas.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-id-card"></i> Solicitudes Matrículas
        </a>
        <a href="{{ route('admin.blog.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-blog"></i> Blog
        </a>
        <a href="{{ route('admin.restauraciones.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="bi bi-tools"></i> Restauraciones
        </a>
        <a href="{{ route('admin.ofertas.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-tags"></i> Ofertas
        </a>
        <a href="{{ route('admin.citas.index') }}" class="list-group-item list-group-item-action text-white">
            <i class="fas fa-calendar-alt"></i> Citas        
        </a>

        <a href="{{ route('index') }}" class="list-group-item list-group-item-action text-white" id="logout-link">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </a>



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
</script>

                </div>
            </nav>

            <!-- Contenido principal -->
            <main class="col-md-9 ml-sm-auto col-lg-10 px-4 content">
                @yield('content')
            </main>

        </div>
    </div>

    <!-- Scripts de Bootstrap -->
         <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

