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

        <div class="container-fluid pt-lg-5 mt-lg-5">
            <div id="map" class="rounded" style="width: 100%; height: 800px;"></div>

            <div class="d-flex align-items-center gap-3">
                <div class="current-location-btn my-4">
                    <button id="locateMeBtn" class="btn btn-dark">
                        <i class="fa-solid fa-location-crosshairs"></i>
                    </button>
                </div>

                <div class="text-dark">
                    Periksa <br>
                    <span>Lokasi saat ini</span>
                </div>
            </div>
        </div>
    </div>
@endvolt
