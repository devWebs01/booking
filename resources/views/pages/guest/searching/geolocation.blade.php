<?php

use function Livewire\Volt\{state};
use App\Models\Rental;

state([
    'firstRental' => fn() => Rental::first(),
]);

?>


@volt
    <div>
        @include('layouts.leaflet-rental')

        <div class="container-fluid">
            <div id="map" class="rounded" style="width: 100%; height: 800px;"></div>

            <div class="d-grid current-location-btn my-4 rounded">
                <button id="locateMeBtn" class="btn btn-dark btn-lg rounded">
                    <i class="fa-solid fa-location-crosshairs"></i>
                    Periksa Lokasi saat ini
                </button>
            </div>
        </div>
    </div>
@endvolt
