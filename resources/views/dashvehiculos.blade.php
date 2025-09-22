@extends('layouts.app')

@section('title', 'TodoMotor - Personal')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/dashvehiculos.css') }}">
    <style>
        .scroll-list {
            max-height: 250px;
            overflow-y: auto;
        }
        .card-title {
            font-size: 1.25rem;
        }
        .card-header {
            background: #ff8000;
            color: #fff;
            font-weight: bold;
        }
        .floating-button {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 999;
        }
        .floating-button a {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #ff8000;
            color: #fff;
            font-size: 1.5rem;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            text-decoration: none;
            transition: background 0.2s;
        }
        .floating-button a:hover {
            background: #e67e22;
            color: #fff;
        }
    </style>
@endpush

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold mb-3">Bienvenido, {{ auth()->user()->nombre }}</h2>
    <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">

    <div class="row g-4">
        <!-- Sección de Coches -->
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">🚗 Tus Coches</h5>
                    <p class="card-text">Selecciona un coche para ver sus detalles.</p>
                    <select id="selectCoche" class="form-select mb-3">
                        @foreach($coches as $coche)
                            <option value="{{ $coche->id }}">{{ $coche->marca }} {{ $coche->modelo }} ({{ $coche->matricula }})</option>
                        @endforeach
                    </select>
                    <div id="datosCoche" class="mt-3 p-2 border rounded bg-light">
                        <h6 class="fw-bold">📋 Información del Coche</h6>
                        <p><strong>Marca:</strong> <span id="marca"></span></p>
                        <p><strong>Modelo:</strong> <span id="modelo"></span></p>
                        <p><strong>Año:</strong> <span id="anio"></span></p>
                        <p><strong>Matrícula:</strong> <span id="matricula"></span></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sección de Reparaciones y Facturas Relacionadas -->
        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">🔧 Reparaciones y Facturas</h5>
                    <input type="text" id="busquedaReparaciones" class="form-control form-control-sm mb-2" placeholder="Buscar reparación o factura...">
                    <ul id="reparaciones" class="scroll-list list-group mb-2">
                        <!-- Reparaciones y facturas se cargarán aquí dinámicamente -->
                    </ul>
                    <button id="btnVerMasReparaciones" class="btn btn-outline-primary btn-sm w-100" style="display: none;">Ver más reparaciones</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Sección de Tus Me gusta -->
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">❤️ Proyectos que te gustan</h5>
            @if($likes->isEmpty())
                <p>No has marcado ningun proyecto con "me gusta".</p>
            @else
                <input type="text" id="busquedaLikes" class="form-control form-control-sm mb-3" placeholder="Buscar proyecto...">
                <div class="row" id="likes-list">
                    @foreach($likes as $like)
                        <div class="col-md-4 mb-3 like-item" 
                             data-titulo="{{ Str::lower($like->restauracion->titulo) }}"
                             data-descripcion="{{ Str::lower($like->restauracion->descripcion) }}">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center like-header" style="cursor:pointer;" data-target="#likeCollapse{{ $like->id }}">
                                    <span>{{ $like->restauracion->titulo }}</span>
                                    <span>
                                        <span class="collapsed-icon">+</span>
                                        <span class="expanded-icon" style="display:none;">−</span>
                                    </span>
                                </div>
                                <div id="likeCollapse{{ $like->id }}" class="collapse">
                                    <div class="card-body">
                                        <p>{{ $like->restauracion->descripcion }}</p>
                                        <div class="row">
                                            <div class="col-6">
                                                <img src="{{ asset($like->restauracion->imagen_antes) }}" alt="Imagen Antes" class="img-fluid rounded">
                                            </div>
                                            <div class="col-6">
                                                <img src="{{ asset($like->restauracion->imagen_despues) }}" alt="Imagen Después" class="img-fluid rounded">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer bg-white border-0">
                                        <form action="{{ route('likes.destroyById', $like->id) }}" method="POST" class="form-quitar-like">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-warning btn-sm w-100 d-flex align-items-center justify-content-center"
                                                style="background-color:#ff8000;border-color:#ff8000;color:#fff;">
                                                <i class="fas fa-thumbs-down me-2"></i> Quitar Me gusta
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Sección de Citas -->
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title fw-bold mb-3">📅 Mis Citas</h5>
            @if($citas->isEmpty())
                <p>No tienes citas programadas.</p>
            @else
                <ul class="list-group">
                    @foreach($citas as $cita)
                        <li class="list-group-item">
                            <strong>Fecha:</strong> {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}<br>
                            <strong>Hora:</strong> {{ $cita->hora }}<br>
                        </li>
                    @endforeach
                </ul>
            @endif
        </div>
    </div>
</div>

<!-- Botón flotante de chat -->
<div class="floating-button">
    <a href="{{ route('chat.index') }}" title="Ir al chat">💬</a>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    let reparacionesData = [];
    let facturasData = [];

    $('#selectCoche').change(function() {
        var cocheId = $(this).val();
        if (cocheId) {
            cargarDatosCoche(cocheId);
        }
    });

    // Cargar datos del primer coche al iniciar
    var primerCocheId = $('#selectCoche').val();
    if (primerCocheId) {
        cargarDatosCoche(primerCocheId);
    }

    function cargarDatosCoche(cocheId) {
        $.ajax({
            url: '/coche/' + cocheId,
            method: 'GET',
            success: function(data) {
                reparacionesData = data.reparaciones || [];
                facturasData = data.facturas || [];
                mostrarReparacionesYFacturas(reparacionesData, facturasData);
                $('#marca').text(data.coche.marca);
                $('#modelo').text(data.coche.modelo);
                $('#anio').text(data.coche.anio);
                $('#matricula').text(data.coche.matricula);
            },
            error: function(xhr) {
                console.error("Error AJAX en cargarDatosCoche:", xhr.responseText);
            }
        });
    }

    function mostrarReparacionesYFacturas(reparaciones, facturas) {
        $('#reparaciones').empty();
        if (reparaciones.length === 0) {
            $('#reparaciones').append('<li class="list-group-item text-muted">Sin reparaciones</li>');
        } else {
            reparaciones.forEach(function(reparacion) {
                let html = '<li class="list-group-item">';
                html += '<strong>' + reparacion.descripcion + '</strong><br>';
                // Formatear fecha de reparación a dd/mm/aaaa
                let fechaSolo = reparacion.fecha ? formatearFecha(reparacion.fecha) : '';
                html += '<span class="text-muted">' + fechaSolo + '</span>';
                // Facturas relacionadas
                let facturasRelacionadas = facturas.filter(function(fac) {
                    return fac.id_reparacion == reparacion.id;
                });
                if (facturasRelacionadas.length > 0) {
                    html += '<ul class="list-group mt-2">';
                    facturasRelacionadas.forEach(function(fac) {
                        // Formatear fecha de factura a dd/mm/aaaa
                        let fechaFac = fac.fecha ? formatearFecha(fac.fecha) : '';
                        html += '<li class="list-group-item py-1 px-2 d-flex justify-content-between align-items-center">';
                        html += '<span><span class="fw-bold">' + fac.monto + ' €</span> <span class="text-muted small">(' + fechaFac + ')</span></span>';
                        html += '<a href="/facturas/' + fac.id + '/pdf" class="btn btn-sm ms-2" style="background-color:#ff8000;border-color:#ff8000;color:#fff;" target="_blank" title="Descargar PDF"><i class="fas fa-file-pdf"></i> Ver factura</a>';
                        html += '</li>';
                    });
                    html += '</ul>';
                }
                html += '</li>';
                $('#reparaciones').append(html);
            });
        }
    }

    // Función para formatear fecha a dd/mm/aaaa
    function formatearFecha(fechaStr) {
        // Soporta formatos con o sin hora
        let partes = fechaStr.split(' ')[0].split('-');
        if (partes.length === 3) {
            // partes[0]=año, partes[1]=mes, partes[2]=día
            return partes[2] + '/' + partes[1] + '/' + partes[0];
        }
        return fechaStr;
    }

    // Filtrado en tiempo real para reparaciones y facturas
    $('#busquedaReparaciones').on('input', function() {
        const texto = $(this).val().toLowerCase();
        // Filtra reparaciones si la descripción o fecha coincide, o alguna factura relacionada coincide
        const filtradas = reparacionesData.filter(function(rep) {
            let matchRep = rep.descripcion.toLowerCase().includes(texto) || (rep.fecha && rep.fecha.toLowerCase().includes(texto));
            let facturasRelacionadas = facturasData.filter(function(fac) {
                return fac.id_reparacion == rep.id &&
                    (
                        (fac.monto && fac.monto.toString().toLowerCase().includes(texto)) ||
                        (fac.fecha && fac.fecha.toLowerCase().includes(texto))
                    );
            });
            return matchRep || facturasRelacionadas.length > 0;
        });
        mostrarReparacionesYFacturas(filtradas, facturasData);
    });

    // Toggle para proyectos "me gusta" al pulsar en toda la barra
    $('.like-header').on('click', function(e) {
        var target = $(this).data('target');
        $(target).collapse('toggle');
    });

    // Cambia el icono +/− al expandir/colapsar
    $('.collapse').on('show.bs.collapse', function () {
        var btn = $(this).closest('.card').find('.like-header');
        btn.find('.collapsed-icon').hide();
        btn.find('.expanded-icon').show();
    }).on('hide.bs.collapse', function () {
        var btn = $(this).closest('.card').find('.like-header');
        btn.find('.collapsed-icon').show();
        btn.find('.expanded-icon').hide();
    });

    // Buscador en tiempo real para proyectos "me gusta"
    $('#busquedaLikes').on('input', function() {
        var texto = $(this).val().toLowerCase();
        $('#likes-list .like-item').each(function() {
            var titulo = $(this).data('titulo');
            var descripcion = $(this).data('descripcion');
            if (titulo.includes(texto) || descripcion.includes(texto)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // AJAX para quitar "Me gusta" sin recargar la página
    $('.form-quitar-like').on('submit', function(e) {
        e.preventDefault();
        var form = $(this);
        var card = form.closest('.like-item');
        $.ajax({
            url: form.attr('action'),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                card.fadeOut(300, function() { $(this).remove(); });
            },
            error: function() {
                alert('Error al quitar el me gusta');
            }
        });
    });
});
</script>
@endpush
@endsection
