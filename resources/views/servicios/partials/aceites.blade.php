<div class="container my-5">
    <h3 class="text-center fw-bold">Cambio de aceite, mantenimiento y revisiones</h3>
    <hr class="mx-auto" style="width: 350px; border-top: 3px solid #ff8000;">

    <div class="row mt-4 g-3">
        <!-- Tarjeta 1 -->
        <div class="col-md-3 col-12">
            <div class="card text-center border-light shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="icon fa-solid fa-oil-can fa-2x mb-2"></i>
                    <h5 class="card-title fw-bold mt-2">CAMBIO ACEITE + FILTRO</h5>
                    <p class="card-text text-muted mb-1">Desde</p>
                    <h3 class="fw-bold mb-0">74 €</h3>
                </div>
            </div>
        </div>

        <!-- Tarjeta 2 -->
        <div class="col-md-3 col-12">
            <div class="card text-center border-light shadow-sm h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="icon fa-solid fa-road fa-2x mb-2"></i>
                    <h5 class="card-title fw-bold mt-2">REVISIÓN DE VIAJE</h5>
                    <p class="card-text text-muted mb-1">Desde</p>
                    <h3 class="fw-bold mb-0">81 €</h3>
                </div>
            </div>
        </div>

        <!-- Tarjeta 3 -->
        <div class="col-md-3 col-12">
            <div class="card text-center border-light shadow-sm bg-lightblue h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="icon fa-solid fa-wrench fa-2x mb-2"></i>
                    <h5 class="card-title fw-bold mt-2">MI REVISIÓN OFICIAL</h5>
                    <p class="text-muted small mb-1">Garantía del fabricante. Para vehículos híbridos.</p>
                    <h3 class="fw-bold text-danger mb-0">76,50 € <span class="text-decoration-line-through text-muted">85 €</span></h3>
                </div>
            </div>
        </div>

        <!-- Tarjeta 4 -->
        <div class="col-md-3 col-12">
            <div class="card text-center border-light shadow-sm bg-lightgreen h-100">
                <div class="card-body d-flex flex-column align-items-center justify-content-center">
                    <i class="icon fa-solid fa-leaf fa-2x mb-2"></i>
                    <h5 class="card-title fw-bold mt-2">MI ECO REVISIÓN OFICIAL</h5>
                    <p class="text-muted small mb-1">Garantía del fabricante. Para vehículos híbridos.</p>
                    <h3 class="fw-bold text-danger mb-0">82,80 € <span class="text-decoration-line-through text-muted">92 €</span></h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de características -->
    <div class="table-responsive mt-4">
        <table class="table table-bordered text-center align-middle">
            <thead class="bg-light">
                <tr>
                    <th>Puntos de control</th>
                    <th>Aceite</th>
                    <th>Filtro + montaje</th>
                    <th>Nivel de líquidos</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>3</td>
                    <td><i class="check fa-solid fa-check"></i></td>
                    <td><i class="check fa-solid fa-check"></i></td>
                    <td>Opcional</td>
                </tr>
                <tr>
                    <td>30</td>
                    <td><i class="check fa-solid fa-check "></i></td>
                    <td><i class="check fa-solid fa-check"></i></td>
                    <td><i class="check fa-solid fa-check"></i></td>
                </tr>
                <tr>
                    <td>Hasta 70</td>
                    <td><i class="check fa-solid fa-check"></i></td>
                    <td><i class="check fa-solid fa-check"></i></td>
                    <td><i class="check fa-solid fa-check"></i></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style>
    body {
        font-family: 'Roboto', sans-serif;
    }

    .bg-lightblue {
        background-color: #e3f2fd !important;
    }

    .bg-lightgreen {
        background-color: #e8f5e9 !important;
    }

    .card {
        transition: transform 0.3s ease-in-out;
        border-radius: 8px;
        min-height: 180px;
    }

    .card:hover {
        transform: scale(1.05);
    }

    .btn-orange {
        background-color: #ff8000;
        border-color: #ff8000;
        color: #fff;
        font-weight: bold;
    }

    .btn-orange:hover {
        background-color: #e67e22;
        border-color: #e67e22;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .check {
        color: #ff8000;
        font-size: 1.2rem;
    }

    .icon {
        color: #ff8000;
    }

    @media (max-width: 767px) {
        .row.g-3 > [class^="col-"] {
            margin-bottom: 1.2rem;
        }
        .card {
            min-height: 150px;
        }
        .card-title {
            font-size: 1.05rem;
        }
        .card-body {
            padding: 1.1rem 0.7rem;
        }
        .table-responsive {
            font-size: 0.97rem;
        }
        .table th, .table td {
            padding: 0.45rem 0.2rem;
        }
    }
</style>
