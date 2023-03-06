@extends('layouts.app')
@section('content')
    <main class="px-3">
        <div class="cont_search">
            <div class="container">
                <div class="row" style="width: auto">
                    <div class="col-md-8">
                        <h2>Search %Hr</h2>
                        <form action="{{ route('search') }}" method="get">
                            @csrf
                            <div class="form-group">
                                <label for="city">
                                    Introduce el nombre de la ciudad
                                </label>
                                <input type="text" class="form-control mt-2" name="city" id="city"
                                    placeholder="Nombre de la ciudad">
                                @error('city')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                                @isset($notFound)
                                    <div class="alert alert-danger mt-3" role="alert">
                                        Ciudad no encontrada, intente de nuevo!
                                    </div>
                                @endisset
                            </div>
                            <button type="submit" class="btn btn-success mt-3">Consultar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="cont_map">
                <div id="map">
                    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
                        integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
                    <script>
                        const map = L.map('map').setView([6.861418573969058, -76.93606079890134], 1);
                        L.marker([25.7825453,-80.2994994]).addTo(map).bindPopup('consultar para ver en tiempo real');                        
                        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                           
                            maxZoom: 13,
                            minZoom: 1,
                            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                        }).addTo(map);

                        var markers = {!! $markers !!};
                        for (let i = 0; i < markers.length; i++) {
                            let marke = markers[i];
                            let lat = marke.lat;
                            let lon = marke.lon;
                            let city = marke.cityName;
                            let wet = marke.wet;
                            let markerLocation = new L.LatLng(lat, lon);
                            let marker = new L.Marker(markerLocation);
                            map.addLayer(marker);
                            marker.bindPopup(city + " - Hr " + wet + "%");
                        }
                    </script>
                </div>
            </div>
        </div>
        <div class="wet">
            <div class="col-md-4">
                @isset($ok)
                    <div class="col-md-12">
                        <h5>{{ $main }}</h5>
                        <h1>{{ intval($wet) }}&#37;Hr</h1>
                    </div>
                    <div class="col-md-12">
                        <h3>{{ $name }}, {{ $country }}</h3>
                    </div>
                    <div class="col-md-12">
                        <h4>{{ $weather }}</h4>
                    </div>
                @endisset
            </div>
        </div>
    </main>
@endsection
