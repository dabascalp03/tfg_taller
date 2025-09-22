@foreach($restauraciones as $restauracion)
    <div class="card my-2">
        <div class="card-body">
            <h5 class="fw-bold">{{ $restauracion->titulo }}</h5>
            <p>{{ $restauracion->descripcion }}</p>
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset($restauracion->imagen_antes) }}" alt="Antes" class="img-thumbnail">
                </div>
                <div class="col-md-6">
                    <img src="{{ asset($restauracion->imagen_despues) }}" alt="Después" class="img-thumbnail">
                </div>
            </div>
        </div>
    </div>
@endforeach

