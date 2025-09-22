@extends('layouts.app')

@section('title', 'TodoMotor - Restauraciones')

@push('styles')
<!-- Estilos personalizados -->
<link rel="stylesheet" href="{{ asset('css/restauraciones.css') }}">
<style>
    /* Encabezado de la página */
    .restauraciones-header {
        background-image: url('{{ asset('img/restauraciones/bannerTitulo.png') }}');
        background-size: cover;
        background-position: center;
        padding: 100px 0;
        text-align: center;
        color: white;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
        width: 100%;
        position: relative;
    }

    img.img-thumbnail {
        width: 350px;
        height: auto;
        border-radius: 5px;
    }

    /* Tarjetas de proyectos */
    .restauracion-card {
        min-height: 480px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    }
    .restauracion-card .card-header {
        min-height: 60px;
        max-height: 70px;
        overflow: hidden;
        display: flex;
        align-items: center;
    }
    .restauracion-title {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 0;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .restauracion-card .card-body {
        flex: 1 1 auto;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding-bottom: 0;
    }
    .descripcion-restauracion, .restauracion-card .card-body > p {
        min-height: 60px;
        max-height: 90px;
        overflow: hidden;
        margin-bottom: 0.5rem;
        color: #222;
    }
    .restauracion-image-wrapper, .restauracion-card .row {
        display: flex;
        flex-direction: row;
        align-items: flex-end;
        gap: 0.5rem;
        margin-top: 18px;
        min-height: 180px;
        max-height: 210px;
    }
    .restauracion-image {
        flex: 1 1 0;
        display: flex;
        align-items: flex-end;
        justify-content: center;
        height: 100%;
    }
    .restauracion-image img {
        width: 100%;
        height: 170px;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #eee;
        margin-bottom: 0.5rem;
        background: #f8f9fa;
        display: block;
    }
    .zona-megusta, .restauracion-card .card-footer {
        min-height: 56px;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
    }
    .like-btn {
        background: none;
        border: none;
        cursor: pointer;
        outline: none;
        padding: 0;
    }
    .like-count {
        font-size: 1rem;
        color: #ff8000;
        font-weight: bold;
    }
    @media (max-width: 767px) {
        .restauracion-card {
            min-height: 420px;
        }
        .restauracion-card .card-header {
            min-height: 56px;
            max-height: 70px;
        }
        .restauracion-title {
            font-size: 1.18rem;
        }
        .descripcion-restauracion, .restauracion-card .card-body > p {
            min-height: 54px;
            max-height: 90px;
        }
        .restauracion-image-wrapper, .restauracion-card .row {
            min-height: 140px;
            max-height: 180px;
        }
        .restauracion-image img {
            height: 130px;
        }
        .zona-megusta, .restauracion-card .card-footer {
            min-height: 54px;
        }
    }
</style>
@endpush

@section('content')
<!-- Encabezado -->
<div class="restauraciones-header">
    <h1 class="fw-bold"> Vuestros Proyectos</h1>
    <p>Descubre increíbles imágenes de coches y motos.</p>
</div>

<!-- Botón desplegable para formulario de restauraciones -->
<div class="container my-5">
    <!-- Mensajes de éxito -->
    @if(session('success'))
        <div class="alert fade show d-flex align-items-center justify-content-between px-4 py-3 mt-4 shadow-sm"
             role="alert"
             style="background-color: #fff4e6; border-left: 5px solid #ff8000; border-radius: 10px; color: #6c3900;">
            <div>
                <i class="fas fa-check-circle me-2" style="color: #ff8000;"></i>
                {{ session('success') }}
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
        </div>
    @endif

    <!-- Mensajes de error -->
    @if($errors->any())
        <div class="alert fade show px-4 py-3 mt-4 shadow-sm"
             role="alert"
             style="background-color: #fff0f0; border-left: 5px solid #dc3545; border-radius: 10px; color: #721c24;">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <i class="fas fa-exclamation-circle me-2" style="color: #dc3545;"></i>
                    <strong>Hubo un problema al enviar el formulario:</strong>
                    <ul class="mb-0 mt-2 ps-3">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <p class="mt-3 mb-0"><em>Consejo: revisa que todos los campos estén completos y que las imágenes sean válidas.</em></p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
            </div>
        </div>
    @endif

    <button id="toggleFormBtn" type="button"
        class="btn fw-bold mb-3 d-flex align-items-center justify-content-center"
        style="
            background: #ff8000;
            color: #fff;
            border: none;
            border-radius: 18px;
            font-size: 1.08rem;
            padding: 10px 26px;
            box-shadow: 0 2px 8px rgba(255,128,0,0.08);
            transition: background 0.18s, color 0.18s, box-shadow 0.18s;
            gap: 0.6rem;
        "
        onmouseover="this.style.background='#e67e22';"
        onmouseout="this.style.background='#ff8000';"
        aria-expanded="false"
        aria-controls="restauracionFormWrapper"
    >
        <i class="fas fa-plus-circle" style="font-size:1.2rem;"></i>
        <span>Añadir tu proyecto</span>
    </button>
    <div id="restauracionFormWrapper" style="display:none;">
        <h3 class="fw-bold text-center">¡Inicia Sesión o Regístrate y sube la tuya!</h3>
        <br>
        @if(Auth::check())
            <form action="{{ route('restauraciones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="titulo" class="form-label">Título del coche:</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" rows="4" class="form-control" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="imagen_antes" class="form-label">Imagen 1:</label>
                    <input type="file" name="imagen_antes" id="imagen_antes" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="imagen_despues" class="form-label">Imagen 2:</label>
                    <input type="file" name="imagen_despues" id="imagen_despues" class="form-control" required>
                </div>
                <button type="submit" class="btn" id="btnEnviar" style="background:#ff8000;color:#fff;">Enviar Proyecto</button>
            </form>
        @else
            <p class="text-center">Para enviar un proyecto, <a href="{{ route('login') }}">inicia sesión</a> o <a href="{{ route('register') }}">regístrate</a>.</p>
        @endif
    </div>
</div>

@push('scripts')
<script>
    $(function () {
        // Botón desplegable para mostrar/ocultar formulario
        $('#toggleFormBtn').on('click', function() {
            var $form = $('#restauracionFormWrapper');
            var expanded = $(this).attr('aria-expanded') === 'true';
            if (expanded) {
                $form.slideUp(200);
                $(this).find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');
                $(this).find('span').text('Añadir tu proyecto');
                $(this).css('background', '#ff8000');
                $(this).attr('aria-expanded', 'false');
            } else {
                $form.slideDown(200);
                $(this).find('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
                $(this).find('span').text('Ocultar formulario');
                $(this).css('background', '#e67e22');
                $(this).attr('aria-expanded', 'true');
            }
        });

        // Like AJAX
        $(".like-btn").click(function () {
            let btn = $(this);
            let postId = btn.data("id");
            let icon = btn.find("i");
            let likeCount = btn.closest('.d-flex').find(".like-count");

            $.ajax({
                url: "/likes/" + postId,
                type: icon.hasClass("text-danger") ? "DELETE" : "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                },
                success: function (response) {
                    if (response.liked) {
                        icon.removeClass("far text-muted").addClass("fas text-danger");
                    } else {
                        icon.removeClass("fas text-danger").addClass("far text-muted");
                    }
                    // Actualiza todos los contadores de la misma restauración en la página
                    $('.like-count[data-id="' + postId + '"]').text(response.count + " Me gusta");
                    // Si solo hay uno, también actualiza el actual
                    likeCount.text(response.count + " Me gusta");
                },
                error: function () {
                    alert("Tienes que iniciar sesion para dar 'Me gusta' a una restauración.");
                },
            });
        });

        // Mejorada barra de búsqueda de proyectos
        let lastQuery = '';
        $('#search').on('input', function () {
            let query = $(this).val().trim();
            $('#search-feedback').hide();
            if (query === '') {
                $('#results').html('');
                $('#clearSearch').hide();
                lastQuery = '';
                return;
            }
            $('#clearSearch').show();
            lastQuery = query;
            $('#search-feedback').text('Buscando proyectos...').show();
            $.ajax({
                url: '/restauraciones/search',
                type: 'GET',
                data: { query: query },
                success: function (data) {
                    if (data.html && data.html.trim() !== '') {
                        $('#results').html(data.html);
                        $('#search-feedback').hide();
                    } else {
                        $('#results').html('');
                        $('#search-feedback').text('No se encontraron proyectos para tu búsqueda.').show();
                    }
                },
                error: function () {
                    $('#results').html('');
                    $('#search-feedback').text('Error al buscar proyectos.').show();
                }
            });
        });

        // Botón para limpiar búsqueda
        $('#clearSearch').on('click', function () {
            $('#search').val('');
            $('#results').html('');
            $('#search-feedback').hide();
            $(this).hide();
        });

        // Mostrar botón de limpiar si hay texto
        $('#search').on('focus input', function () {
            if ($(this).val().trim() !== '') {
                $('#clearSearch').show();
            }
        });

        // Permitir buscar con Enter
        $('#search').on('keypress', function(e) {
            if (e.which === 13) {
                e.preventDefault();
                $(this).trigger('input');
            }
        });
    });
</script>
@endpush

<!-- Restauraciones aceptadas -->
<div class="container">
    <div class="row g-4">
        @forelse ($restauraciones as $restauracion)
            <div class="col-md-6">
                <div class="card restauracion-card">
                    <div class="card-header">
                        <h3 class="restauracion-title">{{ $restauracion->titulo }}</h3>
                    </div>
                    <div class="card-body">
                        <p class="descripcion-restauracion">{{ $restauracion->descripcion }}</p>
                        <div class="restauracion-image-wrapper row">
                            <div class="col-6 restauracion-image">
                                <img src="{{ asset($restauracion->imagen_antes) }}" alt="Imagen Antes">
                            </div>
                            <div class="col-6 restauracion-image">
                                <img src="{{ asset($restauracion->imagen_despues) }}" alt="Imagen Después">
                            </div>
                        </div>
                        <div class="card-footer text-muted zona-megusta">
                            <p class="mb-2">Proyecto de: {{ $restauracion->cliente->nombre ?? 'Cliente desconocido' }}</p>
                            <div class="d-flex align-items-center justify-content-between">
                                <form action="{{ $restauracion->likes->contains('user_id', auth()->id()) ? route('likes.destroy', $restauracion->id) : route('likes.store', $restauracion->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @if($restauracion->likes->contains('user_id', auth()->id()))
                                        @method('DELETE')
                                        <button type="button" class="like-btn" data-id="{{ $restauracion->id }}">
                                            <i class="fas fa-heart text-danger" style="font-size: 1.5rem;"></i>
                                        </button>
                                    @else
                                        <button type="button" class="like-btn" data-id="{{ $restauracion->id }}">
                                            <i class="far fa-heart text-muted" style="font-size: 1.5rem;"></i>
                                        </button>
                                    @endif
                                </form>
                                <span class="like-count ms-2" data-id="{{ $restauracion->id }}">{{ $restauracion->likes->count() }} Me gusta</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center">No hay proyectos aceptados para mostrar aún.</p>
        @endforelse
    </div>
</div>
@endsection
