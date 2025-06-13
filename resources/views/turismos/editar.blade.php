@extends('layout.app')

@section('contenido')
<div style="max-width: 700px; margin: 0 auto; padding: 20px; border-radius: 8px; background: #f9f9f9; box-shadow: 0 0 10px rgba(0,0,0,0.1); font-family: sans-serif;">
    <<form action="{{ route('turismos.update', $turismo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <h1 style="text-align: center; font-size: 24px; font-weight: bold; margin-bottom: 20px;">Editar Sitio Turístico</h1>

        <label for="nombre"><b>Nombre:</b></label><br>
        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $turismo->nombre) }}" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;" required><br>

        <label for="descripcion"><b>Descripción:</b></label><br>
        <textarea name="descripcion" id="descripcion" rows="3" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;" required>{{ old('descripcion', $turismo->descripcion) }}</textarea><br>

        <label for="categoria"><b>Categoría:</b></label><br>
        <input type="text" name="categoria" id="categoria" value="{{ old('categoria', $turismo->categoria) }}" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;" required><br>

        <label for="imagenes"><b>Imágenes (opcional):</b></label><br>
        <input type="file" name="imagenes" id="imagenes" class="form-control mb-3">

        @if($turismo->imagenes)
            <p><b>Imagen actual:</b></p>
            <img src="{{ asset('storage/' . $turismo->imagenes) }}" alt="Imagen actual" style="max-width: 100%; margin-bottom: 16px; border-radius: 4px;">
        @endif

        <label for="latitud"><b>Latitud:</b></label><br>
        <input type="text" name="latitud" id="latitud" value="{{ old('latitud', $turismo->latitud) }}" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;" readonly><br>

        <label for="longitud"><b>Longitud:</b></label><br>
        <input type="text" name="longitud" id="longitud" value="{{ old('longitud', $turismo->longitud) }}" style="width: 100%; padding: 8px; margin-bottom: 16px; border: 1px solid #ccc; border-radius: 4px;" readonly><br>

        <div id="mapa_turismo" style="border: 1px solid #ccc; height: 250px; width: 100%; border-radius: 4px; margin-bottom: 20px;"></div>

        <div style="display: flex; justify-content: space-between;">
            <button type="submit" style="background-color: #2563eb; color: white; padding: 10px 16px; border: none; border-radius: 4px; cursor: pointer;">Guardar Cambios</button>
            <a href="{{ route('turismos.index') }}" style="background-color: #ccc; color: black; padding: 10px 16px; border-radius: 4px; text-decoration: none;">Cancelar</a>
        </div>
    </form>
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
            var nuevaLatitud = this.getPosition().lat();
            var nuevaLongitud = this.getPosition().lng();
            document.getElementById("latitud").value = nuevaLatitud.toFixed(7);
            document.getElementById("longitud").value = nuevaLongitud.toFixed(7);
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
@endsection
