<!doctype html>
<html lang="en">

    <head>
        <title>LARAVEL-MAP</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

        <!-- Bootstrap CSS v5.2.1 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous" />
        <script src="https://kit.fontawesome.com/49d7584956.js" crossorigin="anonymous"></script>


        <!-- Make sure you put this AFTER Leaflet's CSS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
            integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
            integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

        <link rel="stylesheet"
            href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

        <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
        <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

        <script src="/leaflet/leaflet-hash.js"></script>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            * {
                font-family: "Poppins", sans-serif;
                font-weight: 600;
            }

            .current-location-btn {
                position: absolute;
                top: 90px;
                left: 54px;
                z-index: 1000;

            }

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
        
    </head>

    <body>

        <main>
            <div class="container">
                <div id="map" style="width: 100%; height: 800px;"></div>

                <div class="current-location-btn">
                    <button id="locateMeBtn" class="btn btn-primary border">
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </button>
                </div>
            </div>


        </main>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
        </script>

        {{-- <script>
        let map;
        let control;
        let rentals = @json($rentals);

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

        function createButton(label, container) {
            var btn = L.DomUtil.create('button', 'btn btn-primary btn-sm my-1', container);
            btn.setAttribute('type', 'button');
            btn.innerHTML = label;
            return btn;
        }

        function addRentalMarkers(rentals) {
            rentals.forEach(rental => {
                if (rental.latitude && rental.longitude) {
                    let marker = L.marker([rental.latitude, rental.longitude]).addTo(map);

                    // Create container for the popup content
                    var container = L.DomUtil.create('div', 'd-flex flex-column');
                    container.innerHTML = `<b>${rental.name}</b><br>${rental.address}`;

                    // Create buttons
                    var startBtn = createButton('Mulai dari lokasi ini', container);
                    var destBtn = createButton('Pergi ke lokasi ini', container);

                    // Set button click handlers
                    startBtn.onclick = function() {
                        control.spliceWaypoints(0, 1, L.latLng(rental.latitude, rental.longitude));
                        map.closePopup();
                    };

                    destBtn.onclick = function() {
                        control.spliceWaypoints(control.getWaypoints().length - 1, 1, L.latLng(rental.latitude,
                            rental.longitude));
                        map.closePopup();
                    };

                    // Bind the container with buttons to the marker's popup
                    marker.bindPopup(container);
                }
            });
        }

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

        const geolocationPermission = localStorage.getItem('geolocationPermission');

        if (geolocationPermission === 'granted') {
            initializeGeolocation();
        } else if (geolocationPermission !== 'denied') {
            initializeGeolocation();
        } else {
            initializeMap([-1.6235792132201292, 103.57451818465776], 15);
        }

        addRentalMarkers(rentals);

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
    </script> --}}

        <script>
            let map;
        let control;
        let rentals = @json($rentals);

        // Define rental icon using SVG
        const rentalIcon = L.divIcon({
            html: `<svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <circle cx="16" cy="16" r="16" fill="#1E90FF"/>
                     <text x="16" y="21" font-size="16" font-family="Arial" fill="white" text-anchor="middle">R</text>
                   </svg>`,
            className: 'rental-icon', // Optional: Add a class for custom styling
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

        // Define current location icon using SVG
        const currentLocationIcon = L.divIcon({
            html: `<svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill="#dd2c2c" d="M32,0C18.746,0,8,10.746,8,24c0,5.219,1.711,10.008,4.555,13.93c0.051,0.094,0.059,0.199,0.117,0.289l16,24 C29.414,63.332,30.664,64,32,64s2.586-0.668,3.328-1.781l16-24c0.059-0.09,0.066-0.195,0.117-0.289C54.289,34.008,56,29.219,56,24 C56,10.746,45.254,0,32,0z M32,32c-4.418,0-8-3.582-8-8s3.582-8,8-8s8,3.582,8,8S36.418,32,32,32z"></path> </g></svg>`,
            className: 'current-location-icon', // Optional: Add a class for custom styling
            iconSize: [32, 32],
            iconAnchor: [16, 32],
            popupAnchor: [0, -32]
        });

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

        function createButton(label, container) {
            var btn = L.DomUtil.create('button', 'btn btn-primary btn-sm my-1', container);
            btn.setAttribute('type', 'button');
            btn.innerHTML = label;
            return btn;
        }

        function addRentalMarkers(rentals) {
            rentals.forEach(rental => {
                if (rental.latitude && rental.longitude) {
                    let marker = L.marker([rental.latitude, rental.longitude], { icon: rentalIcon }).addTo(map);

                    var container = L.DomUtil.create('div', 'd-flex flex-column');
                    container.innerHTML = `<b>${rental.name}</b><br>${rental.address}`;

                    var startBtn = createButton('Mulai dari lokasi ini', container);
                    var destBtn = createButton('Pergi ke lokasi ini', container);

                    startBtn.onclick = function() {
                        control.spliceWaypoints(0, 1, L.latLng(rental.latitude, rental.longitude));
                        map.closePopup();
                    };

                    destBtn.onclick = function() {
                        control.spliceWaypoints(control.getWaypoints().length - 1, 1, L.latLng(rental.latitude, rental.longitude));
                        map.closePopup();
                    };

                    marker.bindPopup(container);
                }
            });
        }

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

                L.marker(currentLocation, { icon: currentLocationIcon }).addTo(map)
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

        const geolocationPermission = localStorage.getItem('geolocationPermission');

        if (geolocationPermission === 'granted') {
            initializeGeolocation();
        } else if (geolocationPermission !== 'denied') {
            initializeGeolocation();
        } else {
            initializeMap([-1.6235792132201292, 103.57451818465776], 15);
        }

        addRentalMarkers(rentals);

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

        document.getElementById('locateMeBtn').addEventListener('click', function() {
            navigator.geolocation.getCurrentPosition(function(position) {
                var lat = position.coords.latitude;
                var lng = position.coords.longitude;
                var currentLocation = L.latLng(lat, lng);

                control.spliceWaypoints(0, 1, currentLocation);
                map.setView(currentLocation, 15);

                L.marker(currentLocation, { icon: currentLocationIcon }).addTo(map)
                    .bindPopup("Lokasi saat ini!")
                    .openPopup();
            }, function() {
                alert(
                    "Unable to retrieve your location. Please check your location settings and try again."
                );
            });
        });

        var hash = new L.Hash(map);
        </script>




    </body>

</html>
