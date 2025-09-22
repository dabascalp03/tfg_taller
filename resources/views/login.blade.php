<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoMotor - Inicio de Sesión</title>
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
</head>
<body>
    <div class="box">
    <form class="form" id="loginForm" action="{{ route('login') }}" method="POST">
    @csrf <!-- Protección contra ataques CSRF -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <h2 class="fw-bold">Inicio de Sesión</h2>

    <!-- Mensaje de error dinámico -->
    @if(session('error'))
        <p id="errorMensaje" style="color: #FF8000; text-align: center;">{{ session('error') }}</p>
    @endif

    <div class="inputBox">
        <input type="text" name="username" required>
        <span>Usuario:</span>
        <i></i>
    </div>
    <div class="inputBox">
        <input type="password" name="password" required>
        <span>Contraseña:</span>
        <i></i>
    </div>
    <div class="links">
        <a href="{{ route('register') }}">Registro</a>
    </div>
    <input type="submit" value="Entrar">
</form>

    </div>
</body>
</html>

