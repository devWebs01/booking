@push('styles')
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script src="/leaflet/leaflet-hash.js"></script>

    <style>

        /* .current-location-btn {
            position: absolute;
            top: 90px;
            left: 54px;
            z-index: 1000;

        } */

        /* Custom Leaflet Control Styling with Bootstrap */
        .leaflet-routing-container,
        .leaflet-routing-error {
            width: 320px;

            padding-top: 4px;
            transition: all 0.2s ease;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: .25rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }

        .leaflet-control-container .leaflet-routing-container-hide {
            width: 32px;
            height: 32px;
        }

        .leaflet-routing-container h2 {
            font-size: 14px;
        }

        .leaflet-routing-container h3 {
            font-size: 12px;
            font-weight: normal;
        }

        .leaflet-routing-collapsible .leaflet-routing-geocoders {
            margin-top: 20px;
        }

        .leaflet-routing-alt,
        .leaflet-routing-geocoders,
        .leaflet-routing-error {
            padding: 6px;
            margin-top: 2px;
            margin-bottom: 6px;
            border-bottom: none;
            max-height: 320px;
            overflow-y: auto;
            transition: all 0.2s ease;
        }

        .leaflet-control-container .leaflet-routing-container-hide .leaflet-routing-alt,
        .leaflet-control-container .leaflet-routing-container-hide .leaflet-routing-geocoders {
            display: none;
        }

        .leaflet-bar .leaflet-routing-alt:last-child {
            border-bottom: none;
        }

        .leaflet-routing-alt-minimized {

            max-height: 64px;
            overflow: hidden;
            cursor: pointer;
        }

        .leaflet-routing-alt table {
            border-collapse: collapse;
        }

        .leaflet-routing-alt tr:hover {
            background-color: #eee;
            cursor: pointer;
        }

        .leaflet-routing-alt::-webkit-scrollbar {
            width: 8px;
        }

        .leaflet-routing-alt::-webkit-scrollbar-track {
            border-radius: 2px;
            background-color: #eee;
        }

        .leaflet-routing-alt::-webkit-scrollbar-thumb {
            border-radius: 2px;
            background-color: #888;
        }

        .leaflet-routing-icon {
            background-image: url('leaflet.routing.icons.png');
            -webkit-background-size: 240px 20px;
            background-size: 240px 20px;
            background-repeat: no-repeat;
            margin: 0;
            content: '';
            display: inline-block;
            vertical-align: top;
            width: 20px;
            height: 20px;
        }

        .leaflet-routing-icon-continue {
            background-position: 0 0;
        }

        .leaflet-routing-icon-sharp-right {
            background-position: -20px 0;
        }

        .leaflet-routing-icon-turn-right {
            background-position: -40px 0;
        }

        .leaflet-routing-icon-bear-right {
            background-position: -60px 0;
        }

        .leaflet-routing-icon-u-turn {
            background-position: -80px 0;
        }

        .leaflet-routing-icon-sharp-left {
            background-position: -100px 0;
        }

        .leaflet-routing-icon-turn-left {
            background-position: -120px 0;
        }

        .leaflet-routing-icon-bear-left {
            background-position: -140px 0;
        }

        .leaflet-routing-icon-depart {
            background-position: -160px 0;
        }

        .leaflet-routing-icon-enter-roundabout {
            background-position: -180px 0;
        }

        .leaflet-routing-icon-arrive {
            background-position: -200px 0;
        }

        .leaflet-routing-icon-via {
            background-position: -220px 0;
        }

        .leaflet-routing-geocoders div {
            padding: 4px 0px 4px 0px;
        }

        .leaflet-routing-geocoders input {
            width: 100%;
            line-height: 1.67;
            border: 1px solid #ccc;
            padding: .375rem .75rem;
            border-radius: .25rem;
            margin-bottom: .5rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
        }

        .leaflet-routing-geocoders input:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }

        .leaflet-routing-geocoders button {
            position: static;
            margin-top: 15px;
            margin-right: 0;

        }

        .leaflet-routing-remove-waypoint,
        .leaflet-routing-add-waypoint {
            position: absolute;
            right: .75rem;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            border-radius: .25rem;
            padding: .25rem .5rem;
            cursor: pointer;
            transition: background-color .15s ease-in-out;
        }


        .leaflet-routing-remove-waypoint:after {
            content: "\00d7";
            /* x symbol */
            color: rgb(227, 18, 18);
            font-weight: bold;
        }

        .leaflet-routing-instruction-distance {
            width: 48px;
        }

        .leaflet-routing-collapse-btn {
            position: absolute;
            top: 0;
            right: 6px;
            font-size: 24px;

            font-weight: bold;
        }

        .leaflet-routing-collapse-btn:after {
            content: '\00d7';
        }

        .leaflet-routing-container-hide .leaflet-routing-collapse-btn {
            position: relative;
            left: 4px;
            top: 4px;
            display: block;
            width: 26px;
            height: 23px;
            background-image: url('routing-icon.png');
        }

        .leaflet-routing-container-hide .leaflet-routing-collapse-btn:after {
            content: none;
        }

        .leaflet-top .leaflet-routing-container.leaflet-routing-container-hide {
            margin-top: 10px !important;
        }

        .leaflet-right .leaflet-routing-container.leaflet-routing-container-hide {
            margin-right: 10px !important;
        }

        .leaflet-bottom .leaflet-routing-container.leaflet-routing-container-hide {
            margin-bottom: 10px !important;
        }

        .leaflet-left .leaflet-routing-container.leaflet-routing-container-hide {
            margin-left: 10px !important;
        }

        @media only screen and (max-width: 640px) {
            .leaflet-routing-container {
                margin: 0 !important;
                padding: 0 !important;
                width: 100%;
                height: 100%;
            }
        }
    </style>
@endpush

@push('scripts')
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
                    .bindPopup("Lokasi saat ini!")
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
                startBtn = createButton('Mulai dari lokasi ini', container),
                destBtn = createButton('Pergi ke lokasi ini', container);

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
                    .bindPopup("Lokasi saat ini!")
                    .openPopup();
            }, function() {
                alert(
                    "Unable to retrieve your location. Please check your location settings and try again."
                );
            });
        });

        // Assuming your map instance is in a variable called map
        var hash = new L.Hash(map);
    </script>
@endpush
