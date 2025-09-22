<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TodoMotor - Registro</title>
    <link rel="stylesheet" href="{{ asset('css/registro.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('img/TDM.png') }}">

</head>
<body>
    <div class="box">
        <div class="form">
            <h2>Registro</h2>

            @if(session('success'))
                <p style="color: green; text-align: center;">{{ session('success') }}</p>
            @endif

            @if ($errors->any())
                <div style="color: red; text-align: center;">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('register.store') }}">
                @csrf

                <div class="inputBox">
                    <input type="text" name="nombre" required>
                    <span>Nombre Completo:</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="email" name="email" required>
                    <span>Correo Electrónico:</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="text" name="username" required>
                    <span>Nombre de Usuario:</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" name="password" required>
                    <span>Contraseña:</span>
                    <i></i>
                </div>

                <div class="inputBox">
                    <input type="password" name="password_confirmation" required>
                    <span>Confirmar Contraseña:</span>
                    <i></i>
                </div>

                <div class="mb-3" style="margin-top:18px;">
                    <input type="checkbox" id="aceptoDatos" name="aceptoDatos" required>
                    <label for="aceptoDatos" style="font-size:0.98rem; color:#fff;">
                        Acepto el 
                        <a href="{{ url('/politica-cookies') }}" target="_blank" style="color:#ff8000;text-decoration:underline;font-weight:500;">
                            uso de mis datos personales
                        </a>
                    </label>
                </div>
                <style>
                    #aceptoDatos {
                        accent-color: #ff8000;
                        width: 18px;
                        height: 18px;
                        vertical-align: middle;
                        margin-right: 7px;
                    }
                    #registerForm input[type="submit"] {
                        background: #ff8000;
                        color: #fff;
                        border: none;
                        border-radius: 25px;
                        font-weight: bold;
                        font-size: 1.1rem;
                        padding: 10px 0;
                        margin-top: 10px;
                        box-shadow: 0 2px 8px rgba(255,128,0,0.08);
                        transition: background 0.2s, color 0.2s;
                        width: 100%;
                        cursor: pointer;
                    }
                    #registerForm input[type="submit"]:hover {
                        background: #e67e22;
                        color: #fff;
                    }
                    #registerForm label[for="aceptoDatos"] a:hover {
                        color: #e67e22 !important;
                    }
                </style>

                <div class="links">
                    <a href="{{ route('login') }}">Iniciar sesión</a>
                </div>

                <input type="submit" value="Registrar">
            </form>
            <script>
                document.getElementById('registerForm').onsubmit = function() {
                    if (!document.getElementById('aceptoDatos').checked) {
                        alert('Debes aceptar el uso de tus datos personales para registrarte.');
                        return false;
                    }
                };
            </script>
        </div>
    </div>
</body>
</html>


