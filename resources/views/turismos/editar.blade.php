@extends('layout.app')

@section('contenido')
<br><br><br><br>
<div class="container mt-4">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-warning text-white text-center">
            <h4 class="mb-0">Editar Sitio Turístico</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('turismos.update', $turismo->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $turismo->nombre) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control" required>{{ old('descripcion', $turismo->descripcion) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label fw-bold">Categoría:</label>
                    <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $turismo->categoria) }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="imagenes" class="form-label fw-bold">Imagen (opcional):</label>
                    <input type="file" name="imagenes" id="imagenes" class="form-control" accept="image/*">
                </div>

                @if($turismo->imagenes)
                    <div class="mb-3 text-center">
                        <label class="form-label fw-bold">Imagen actual:</label><br>
                        <img src="{{ asset('storage/' . $turismo->imagenes) }}" alt="Imagen actual" class="img-fluid rounded" style="max-height: 200px;">
                    </div>
                @endif

                <div class="mb-3">
                    <label for="latitud" class="form-label fw-bold">Latitud:</label>
                    <input type="text" name="latitud" id="latitud" value="{{ old('latitud', $turismo->latitud) }}" class="form-control bg-light" readonly>
                </div>

                <div class="mb-3">
                    <label for="longitud" class="form-label fw-bold">Longitud:</label>
                    <input type="text" name="longitud" id="longitud" value="{{ old('longitud', $turismo->longitud) }}" class="form-control bg-light" readonly>
                </div>

                <div id="mapa_turismo" class="border" style="height: 250px; margin-bottom: 20px; border-radius: 5px;"></div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Guardar Cambios
                    </button>
                    <a href="{{ route('turismos.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function initMap() {
        var lat = parseFloat("{{ old('latitud', $turismo->latitud ?? '-0.9374805') }}") || -0.9374805;
        var lng = parseFloat("{{ old('longitud', $turismo->longitud ?? '-78.6161327') }}") || -78.6161327;
        var ubicacion = new google.maps.LatLng(lat, lng);

        var mapa = new google.maps.Map(document.getElementById('mapa_turismo'), {
            center: ubicacion,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var marcador = new google.maps.Marker({
            position: ubicacion,
            map: mapa,
            title: "Ubicación del sitio turístico",
            draggable: true
        });

        google.maps.event.addListener(marcador, 'dragend', function (event) {
            document.getElementById("latitud").value = this.getPosition().lat().toFixed(7);
            document.getElementById("longitud").value = this.getPosition().lng().toFixed(7);
        });
    }
    window.onload = initMap;
</script>

<script>
    $("#imagenes").fileinput({
        language: "es",
        allowedFileExtensions: ["png", "jpg", "jpeg"],
        showCaption: false,
        dropZoneEnabled: true,
        showClose: false
    });
</script>
<br><br><br>
@endsection
