<form action="{{ route('solicitud-vehiculo.store') }}" method="POST" class="p-4 bg-white shadow rounded">
    @csrf

    <h5 class="text-center mb-4">Cuando lo envies, un administrador revisará tu solicitud</h5>

    <div class="mb-3">
        <label for="marca" class="form-label">Marca</label>
        <input type="text" class="form-control" id="marca" name="marca" required>
    </div>

    <div class="mb-3">
        <label for="modelo" class="form-label">Modelo</label>
        <input type="text" class="form-control" id="modelo" name="modelo" required>
    </div>

    <div class="mb-3">
        <label for="anio" class="form-label">Año</label>
        <input type="number" class="form-control" id="anio" name="anio" min="1900" max="{{ date('Y') }}" required>
    </div>

    <div class="mb-3">
        <label for="placa" class="form-label">Matrícula</label>
        <input type="text" class="form-control" id="placa" name="placa" required>
    </div>

    <button type="submit" class="btn w-100" style="background-color:#ff8000;">Registrar</button>
</form>
