@extends('layout.app')

@section('contenido')
<br><br>
<div class="container mt-4">
    <div class="card shadow mx-auto" style="max-width: 600px;">
        <div class="card-header bg-primary text-white text-center">
            <h4 class="mb-0">Registrar Nuevo Sitio Turístico</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('turismos.store') }}" method="post" enctype="multipart/form-data" id="frm_turismo">
                @csrf

                <div class="mb-3">
                    <label for="nombre" class="form-label fw-bold">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="descripcion" class="form-label fw-bold">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" rows="3" class="form-control"></textarea>
                </div>

                <div class="mb-3">
                    <label for="categoria" class="form-label fw-bold">Categoría:</label>
                    <input type="text" name="categoria" id="categoria" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="imagenes" class="form-label fw-bold">Imagen:</label>
                    <input type="file" name="imagenes" id="imagenes" accept="image/*" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="latitud" class="form-label fw-bold">Latitud:</label>
                    <input type="text" name="latitud" id="latitud" class="form-control bg-light" readonly>
                </div>

                <div class="mb-3">
                    <label for="longitud" class="form-label fw-bold">Longitud:</label>
                    <input type="text" name="longitud" id="longitud" class="form-control bg-light" readonly>
                </div>

                <div id="mapa_turismo" class="border" style="height: 250px; margin-bottom: 20px;"></div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> Guardar
                    </button>
                    <a href="{{ route('turismos.index') }}" class="btn btn-outline-danger">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    function initMap() {
        var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);
        var mapa = new google.maps.Map(document.getElementById('mapa_turismo'), {
            center: latitud_longitud,
            zoom: 15,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });
        var marcador = new google.maps.Marker({
            position: latitud_longitud,
            map: mapa,
            title: "Seleccione la dirección",
            draggable: true
        });
        google.maps.event.addListener(marcador, 'dragend', function (event) {
            document.getElementById("latitud").value = this.getPosition().lat();
            document.getElementById("longitud").value = this.getPosition().lng();
        });
    }
</script>

<script>
    $(document).ready(function () {
        $("#frm_turismo").validate({
            rules: {
                "nombre": {
                    required: true,
                    minlength: 3,
                    maxlength: 50
                },
                "descripcion": {
                    required: true,
                    minlength: 10,
                    maxlength: 255
                },
                "categoria": {
                    required: true,
                    minlength: 3,
                    maxlength: 30
                },
                "imagenes": {
                    required: true,
                    extension: "jpg|jpeg|png|gif"
                },
                "latitud": {
                    required: true
                },
                "longitud": {
                    required: true
                }
            },
            messages: {
                "nombre": {
                    required: "Campo obligatorio",
                    minlength: "Debe tener al menos 3 caracteres",
                    maxlength: "Nombre muy largo (máx. 50 caracteres)"
                },
                "descripcion": {
                    required: "Campo obligatorio",
                    minlength: "Debe tener al menos 10 caracteres",
                    maxlength: "Descripción demasiado larga (máx. 255 caracteres)"
                },
                "categoria": {
                    required: "Ingrese la categoría",
                    minlength: "Debe tener al menos 3 caracteres",
                    maxlength: "Categoría muy larga (máx. 30 caracteres)"
                },
                "imagenes": {
                    required: "Debe seleccionar una imagen",
                    extension: "Solo se permiten archivos JPG, JPEG, PNG o GIF"
                },
                "latitud": {
                    required: "Seleccione una ubicación en el mapa"
                },
                "longitud": {
                    required: "Seleccione una ubicación en el mapa"
                }
            }
        });
    });
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
