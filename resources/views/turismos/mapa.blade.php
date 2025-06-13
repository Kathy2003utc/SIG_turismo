@extends('layout.app')

@section('contenido')
<br>
<h1 class="text-center">MAPA GLOBAL DE PUNTOS TURÍSTICOS</h1>
<br>

<div id="mapa-turismo" style="border: 2px solid #ccc; height: 500px; width: 100%; border-radius: 10px;"></div>

<script type="text/javascript">
    function initMap() {
        var centro = new google.maps.LatLng(-0.9374805, -78.6161327);

        var mapa = new google.maps.Map(document.getElementById('mapa-turismo'), {
            center: centro,
            zoom: 10,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        @foreach($turismos as $turismo)
            (function () {
                var coordenada = new google.maps.LatLng({{ $turismo->latitud }}, {{ $turismo->longitud }});

                var marcador = new google.maps.Marker({
                    position: coordenada,
                    map: mapa,
                    icon: {
                        url: "https://cdn-icons-png.flaticon.com/512/4899/4899329.png",
                        scaledSize: new google.maps.Size(50, 50)
                    },
                    draggable: false
                });

                var contenido = `
                    <div style="font-family: 'Segoe UI', sans-serif; background-color: #f9f9f9; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); padding: 15px; max-width: 300px;">
                        <h5 class="text-center" style="color: #2c3e50; margin-bottom: 5px; font-size: 20px;">{{ $turismo->nombre }}</h5>
                        <p style="margin: 5px 0 10px; font-size: 14px; color: #555;">{{ $turismo->descripcion }}</p>
                        <p style="margin: 3px 0;"><strong>Categoría:</strong> {{ $turismo->categoria }}</p>
                        <p style="margin: 3px 0;"><strong>Coordenadas:</strong> {{ $turismo->latitud }}, {{ $turismo->longitud }}</p>
                        @if($turismo->imagenes)
                            <img src="{{ asset('storage/' . $turismo->imagenes) }}" alt="Imagen del lugar" style="width: 100%; max-height: 150px; object-fit: cover; border-radius: 8px;">
                        @else
                            <p style="color: #888;"><em>Imagen no disponible</em></p>
                        @endif
                    </div>
                `;

                var infoWindow = new google.maps.InfoWindow({
                    content: contenido
                });

                marcador.addListener('click', function () {
                    infoWindow.open(mapa, marcador);
                });
            })();
        @endforeach
    }
</script>
@endsection
