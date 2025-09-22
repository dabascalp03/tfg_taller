@extends('layouts.app')

@section('title', 'TodoMotor - Calendario Citas')

@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/css/bootstrap-timepicker.min.css">
<style>
    .fc-toolbar-title {
        font-size: 1.6rem;
        font-weight: bold;
        color: #ff8000;
    }
    .fc-button, .fc-button-primary {
        background: #ff8000 !important;
        border: none !important;
        color: #fff !important;
        transition: background 0.2s;
        box-shadow: none !important;
    }
    .fc-button:hover, .fc-button-primary:hover, .fc-button:focus, .fc-button-primary:focus, .fc-button-active, .fc-button-primary:active {
        background: #e67e22 !important;
        color: #fff !important;
    }
    .fc-button-group .fc-button {
        border-radius: 20px !important;
        margin-right: 4px;
        font-weight: 500;
        font-size: 1rem;
        padding: 0.4rem 1.1rem;
    }
    .fc-button-active, .fc-button-primary.fc-button-active {
        background: #ff8000 !important;
        color: #fff !important;
        border: 2px solid #fff7e6 !important;
    }
    .fc-day-today {
        background: #fff7e6 !important;
    }
    .fc-event {
        background: #ff8000 !important;
        border: none !important;
        color: #fff !important;
        font-weight: 500;
    }
    .modal-header {
        background: #ff8000;
        color: #fff;
    }
    .btn-primary, .btn-primary:focus {
        background: #ff8000;
        border: none;
    }
    .btn-primary:hover {
        background: #e67e22;
    }
    .timepicker {
        border-radius: 20px;
        border: 1.5px solid #ff8000;
        padding-left: 1rem;
    }
    #calendar {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(255,128,0,0.07);
        padding: 1.5rem 1rem;
        margin-bottom: 2rem;
    }
    @media (max-width: 767px) {
        #calendar {
            padding: 0.5rem 0.2rem;
            font-size: 0.95rem;
        }
        .fc-toolbar-title {
            font-size: 1.1rem;
        }
        .modal-dialog {
            max-width: 95vw;
            margin: 1.2rem auto;
        }
        .modal-content {
            font-size: 0.98rem;
        }
        .btn-primary, .btn {
            font-size: 1rem;
        }
        .fc .fc-toolbar.fc-header-toolbar {
            flex-direction: column;
            gap: 0.5rem;
        }
        .fc .fc-toolbar-chunk {
            margin-bottom: 0.2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <h2 class="text-center fw-bold mb-3"">Reservar Nueva Cita</h2>
    <hr class="mx-auto" style="width: 350px; border-top: 3px solid orange;">

{{-- ALERTAS --}}
@if(session('success'))
<div class="alert fade show d-flex align-items-center justify-content-between px-4 py-3 mb-4 shadow-sm"
     role="alert"
     style="background-color: #fff4e6; border-left: 5px solid #ff8000; border-radius: 10px; color: #6c3900;">
    <div>
        <i class="fas fa-check-circle me-2" style="color: #ff8000;"></i>
        {{ session('success') }}
    </div>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
</div>
@endif

@if($errors->any())
<div class="alert fade show px-4 py-3 mb-4 shadow-sm"
     role="alert"
     style="background-color: #fff0f0; border-left: 5px solid #dc3545; border-radius: 10px; color: #721c24;">
    <div class="d-flex justify-content-between align-items-start">
        <div>
            <i class="fas fa-exclamation-circle me-2" style="color: #dc3545;"></i>
            <strong>Por favor corrige los errores:</strong>
            <ul class="mb-0 mt-2 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button>
    </div>
</div>
@endif
{{-- FIN ALERTAS --}}


    <div id="calendar" style="height: 700px; max-width: 100%;"></div>

    <!-- Modal para seleccionar la hora -->
    <div class="modal fade" id="timePickerModal" tabindex="-1" aria-labelledby="timePickerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="timePickerModalLabel">Seleccionar Hora</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="timePickerForm">
                        <div class="form-group mb-3">
                            <label for="hora" class="fw-bold">Hora:</label>
                            <input type="text" id="hora" class="form-control timepicker" placeholder="Selecciona la hora" autocomplete="off">
                        </div>
                        <button type="button" class="btn btn-primary w-100" id="confirmTime">Confirmar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var selectedDate = null;

    // Ajuste de altura para móviles
    function getCalendarHeight() {
        if (window.innerWidth < 768) {
            return 420;
        }
        return 700;
    }

    // Inicializar el calendario
    var calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'es',
        initialView: window.innerWidth < 768 ? 'timeGridDay' : 'timeGridWeek',
        selectable: true,
        height: getCalendarHeight(),
        headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek'
        },
        slotMinTime: "08:00",
        slotMaxTime: "20:00",
        validRange: {
            start: new Date().toISOString().slice(0,10),
            end: '2025-12-31'
        },
        events: '/citas/ocupadas',

        selectAllow: function(selectInfo) {
            var horaSeleccionada = selectInfo.start.getHours();
            return (horaSeleccionada >= 8 && horaSeleccionada <= 13) || (horaSeleccionada >= 15 && horaSeleccionada <= 19);
        },

        select: function(info) {
            selectedDate = info.startStr.split('T')[0];
            $('#hora').val('');
            $('#timePickerModal').modal('show');
        }
    });

    calendar.render();

    // Responsive: cambia vista y altura al redimensionar
    window.addEventListener('resize', function() {
        calendar.changeView(window.innerWidth < 768 ? 'timeGridDay' : 'timeGridWeek');
        calendar.setOption('height', getCalendarHeight());
    });

    // Inicializar Bootstrap Timepicker con restricciones de horarios
    $('.timepicker').timepicker({
        showMeridian: false,
        minuteStep: 15,
        defaultTime: false,
        disableTimeRanges: [
            ['00:00', '08:00'],
            ['13:01', '15:00'],
            ['19:01', '23:59']
        ]
    });

    // Confirmar la hora seleccionada
    document.getElementById('confirmTime').addEventListener('click', function() {
        var hora = $('#hora').val();

        // Validar si la hora está en los rangos permitidos
        var [hh, mm] = hora.split(':').map(Number);
        if ((hh >= 8 && hh <= 13) || (hh >= 15 && hh <= 19)) {
            $('#timePickerModal').modal('hide');

            // Enviar la solicitud de reserva
            fetch('/citas/reservar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    fecha: selectedDate,
                    hora: hora,
                    servicio: 'Consulta'
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    showToast('Cita reservada correctamente.', 'success');
                    calendar.refetchEvents();
                } else {
                    showToast(data.error || 'Ocurrió un error al reservar la cita.', 'danger');
                }
            })
            .catch(error => {
                showToast('Error de conexión al reservar la cita.', 'danger');
            });
        } else {
            showToast('La hora seleccionada no está permitida. Elige un horario válido.', 'warning');
        }
    });

    // Toast feedback
    function showToast(message, type) {
        let toast = $('<div class="toast align-items-center text-bg-' + type + ' border-0" role="alert" aria-live="assertive" aria-atomic="true" style="position:fixed;top:90px;right:30px;z-index:9999;">' +
            '<div class="d-flex"><div class="toast-body">' + message + '</div>' +
            '<button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button></div></div>');
        $('body').append(toast);
        var bsToast = new bootstrap.Toast(toast[0], { delay: 2500 });
        bsToast.show();
        toast.on('hidden.bs.toast', function () { $(this).remove(); });
    }
});
</script>
@endpush
