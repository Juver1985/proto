@extends('layouts.master')

@section('content')
<div class="container">
    <h1>Georreferenciación de Fincas</h1>
    <div id="map" style="height: 500px;"></div>
</div>

<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: { lat: 3.4516, lng: -76.5320 }, // Coordenadas de Cali, Colombia
            zoom: 8
        });

        @foreach ($fincas as $finca)
            new google.maps.Marker({
                position: { lat: {{ $finca->latitud }}, lng: {{ $finca->longitud }} },
                map: map,
                title: "{{ $finca->nombre }}"
            });
        @endforeach
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AQUI_TU_API_KEY&callback=initMap" async defer></script>

@endsection
