@extends('layout.app')

@section('contenido')
<br>
<h1>MAPA GLOBAL</h1>
<br>
<div id="mapa-turismo" style="border : 2px solid black; height:500px; width:100%;">

</div>

<script type="text/javascript">
    function initMap() {
        var latitud_longitud = new google.maps.LatLng(-0.9374805, -78.6161327);

        var mapa = new google.maps.Map(
            document.getElementById('mapa-turismo'),
            {
                center: latitud_longitud,
                zoom: 12,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
        );

        @foreach($turismos as $turismo)
            (function() {
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
                    <div style="font-family:sans-serif;">
                        <h5>{{ $turismo->nombre }}</h5>
                        <p><strong>Categoría:</strong> {{ $turismo->categoria }}</p>
                        <p>{{ $turismo->descripcion }}</p>
                        @if($turismo->imagenes)
                            <img src="{{ Storage::url($turismo->imagenes) }}" alt="Imagen" width="150">
                        @endif
                    </div>
                `;

                var infoWindow = new google.maps.InfoWindow({
                    content: contenido
                });

                marcador.addListener('click', function() {
                    infoWindow.open(mapa, marcador);
                });
            })();
        @endforeach
    }
</script>




@endsection