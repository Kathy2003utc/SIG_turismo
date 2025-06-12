@extends('layout.app')

@section('contenido')
<form action="{{ route('turismos.store') }}" method="post" enctype="multipart/form-data" style="width: 50%; margin: auto; font-family: Arial, sans-serif; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
    @csrf
    <h1 style="text-align: center; color: #333;">Registrar Nuevo Sitio Turístico</h1>

    <label for="nombre" style="font-weight: bold;">Nombre:</label><br>
    <input type="text" name="nombre" id="nombre" style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

    <label for="descripcion" style="font-weight: bold;">Descripción:</label><br>
    <textarea name="descripcion" id="descripcion" rows="3" style="width: 100%; padding: 8px; margin-bottom: 10px;"></textarea><br>

    <label for="categoria" style="font-weight: bold;">Categoría:</label><br>
    <input type="text" name="categoria" id="categoria" style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>

    <label for="imagenes" style="font-weight: bold;">Imagen:</label><br>
    <input type="file" name="imagenes" id="imagenes" accept="image/*" style="width: 100%; padding: 8px; margin-bottom: 10px;"><br>


    <label for="latitud" style="font-weight: bold;">Latitud:</label><br>
    <input type="text" name="latitud" id="latitud" style="width: 100%; padding: 8px; margin-bottom: 10px; background-color: #f0f0f0;"><br>

    <label for="longitud" style="font-weight: bold;">Longitud:</label><br>
    <input type="text" name="longitud" id="longitud" style="width: 100%; padding: 8px; margin-bottom: 10px; background-color: #f0f0f0;"><br>

    <div id="mapa_turismo" style="border: 1px solid black; height: 250px; width: 100%; margin-top: 10px; margin-bottom: 20px;"></div>

    <button type="submit" style="background-color: green; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">Guardar</button>

    <a href="{{ route('turismos.index') }}" style="margin-left: 20px; text-decoration: none; color: red; font-weight: bold; padding: 10px 20px;">Cancelar</a>
</form>

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
    $("#imagenes").fileinput({
        language: "es",
        allowedFileExtensions: ["png", "jpg", "jpeg"],
        showCaption: false,
        dropZoneEnabled: true,
        showClose: false
    });
</script>

@endsection
