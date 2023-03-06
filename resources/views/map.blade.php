@extends('index')

{{-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url("https://unpkg.com/leaflet@1.9.3/dist/leaflet.css");

        #map {
            margin: 0 auto;
            height: 50%;
            min-height: 300px;
            max-height: 400px;
            width: 70%;
        }
    </style>

</head>

<body> --}}
    @section('map')
    <div id="map">
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <script>
            const map = L.map('map').setView([6.861418573969058, -76.93606079890134], 3);

            L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            L.marker([-4.577207614023301, -54.86134262282784]).addTo(map);

            var markers = {!! $markers !!};
            console.log(markers);
            for (let i = 0; i < markers.length; i++) {
                let markerr = markers[i];
                let lat = markerr.lat;
                let lon = markerr.lon;

                var markerLocation = new L.LatLng(lat, lon);
                var marker = new L.Marker(markerLocation);
                map.addLayer(marker);
                // marker.bindPopup(popupText)
            }
        </script>
    </div>
@endsection
{{-- </body> --}}


{{-- </html> --}}
