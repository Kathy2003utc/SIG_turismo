@extends('layout.app')

@section('contenido')
<br>
<h1>MAPA GLOBAL</h1>
<br>
<div id="mapa-turismo" style="border : 2px solid black; height:500px; width:100%;">

</div>

<script type="text/javascript">
    function initMap(){
        //alert("mapa ok");
        var latitud_longitud= new google.maps.LatLng(-0.9374805,-78.6161327);
        var mapa=new google.maps.Map(
            document.getElementById('mapa-turismo'),
            {
                center:latitud_longitud,
                zoom:15,
                mapTypeId:google.maps.MapTypeId.ROADMAP
            }
        );
        @foreach($turismos as $turismos)
            var cordenadaCliente= new google.maps.LatLng({{$turismos->latitud}}, 
                                        {{$turismos->longitud}});
            var marcador=new google.maps.Marker({
                position:cordenadaCliente,
                map:mapa,
                icon:"https://cdn-icons-png.flaticon.com/512/4899/4899329.png",
                title:"{{$clienteTemporal->apellido}} {{$clienteTemporal->nombre}}",
                draggable:false
            });
        @endforeach
    }
</script>


@endsection