<!doctype html>
<html lang="en">

<head>
    <title>LARAVEL-MAP</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />


    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script src="https://kit.fontawesome.com/49d7584956.js" crossorigin="anonymous"></script>

    <style>
        .current-location-btn {
            position: absolute;
            bottom: 20px;
            /* Mengatur posisi ke bawah */
            right: 20px;
            /* Mengatur posisi ke kanan */
            z-index: 1000;
            background: white;
        }
    </style>
    @vite([])
</head>

<body>

    <main>

        <div id="map" style="width: 100%; height: 800px;"></div>

        <div class="current-location-btn">
            <button id="locateMeBtn" class="btn btn-outline-primary">
                <i class="fa-solid fa-location-crosshairs"></i>
            </button>
        </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

    <script>
        let map;
        let control;

        function initializeMap(center, zoom) {
            map = L.map('map').setView(center, zoom);
            L.tileLayer('http://{s}.google.com/vt?lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }).addTo(map);

            control = L.Routing.control({
                waypoints: [
                    L.latLng(null),
                    L.latLng(null)
                ],
                routeWhileDragging: true,
                geocoder: L.Control.Geocoder.nominatim()
            }).addTo(map);
        }

        // Fungsi untuk mengaktifkan geolocation tanpa pertanyaan jika sebelumnya diizinkan
        function initializeGeolocation() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var currentLocation = L.latLng(lat, lng);

                if (map) {
                    map.setView(currentLocation, 15);
                    control.spliceWaypoints(0, 1, currentLocation);
                } else {
                    initializeMap(currentLocation, 15);
                }

                L.marker(currentLocation).addTo(map)
                    .bindPopup("You are here!")
                    .openPopup();

                localStorage.setItem('geolocationPermission', 'granted');
            }, function() {
                localStorage.setItem('geolocationPermission', 'denied');
                alert(
                    "Unable to retrieve your location. Please refresh the page if you want to enable location services."
                );
            });
        }

        // Mengecek status izin geolokasi di localStorage
        const geolocationPermission = localStorage.getItem('geolocationPermission');

        if (geolocationPermission === 'granted') {
            initializeGeolocation();
        } else if (geolocationPermission !== 'denied') {
            initializeGeolocation();
        } else {
            initializeMap([-1.6235792132201292, 103.57451818465776], 15);
        }

        // Fungsi untuk membuat tombol dengan gaya Bootstrap
        function createButton(label, container) {
            var btn = L.DomUtil.create('button', 'btn btn-primary btn-sm my-1', container);
            btn.setAttribute('type', 'button');
            btn.innerHTML = label;
            return btn;
        }

        // Event click pada peta untuk menampilkan popup dengan tombol
        map.on('click', function(e) {
            var container = L.DomUtil.create('div', 'd-flex flex-column'),
                startBtn = createButton('Start from this location', container),
                destBtn = createButton('Go to this location', container);

            startBtn.onclick = function() {
                control.spliceWaypoints(0, 1, e.latlng);
                map.closePopup();
            };

            destBtn.onclick = function() {
                control.spliceWaypoints(control.getWaypoints().length - 1, 1, e.latlng);
                map.closePopup();
            };

            L.popup()
                .setContent(container)
                .setLatLng(e.latlng)
                .openOn(map);
        });

        // Event klik pada tombol Lokasi Saya
        document.getElementById('locateMeBtn').addEventListener('click', function() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var currentLocation = L.latLng(lat, lng);

                control.spliceWaypoints(0, 1, currentLocation);
                map.setView(currentLocation, 15);

                L.marker(currentLocation).addTo(map)
                    .bindPopup("You are here!")
                    .openPopup();
            }, function() {
                alert(
                    "Unable to retrieve your location. Please check your location settings and try again."
                    );
            });
        });
    </script>
</body>

</html>
