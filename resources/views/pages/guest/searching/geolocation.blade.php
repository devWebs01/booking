<?php

use function Livewire\Volt\{state};
use App\Models\Shop;

state([
    'shop' => fn() => Shop::first(),
]);

?>


@volt
    <div>
        {{-- <div class="container rounded">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15952.808798997145!2d103.61258674747606!3d-1.6308447245373325!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e258746bea4f70d%3A0xe4cc5dbf51a39b33!2sAquina%20Rental%20Jambi!5e0!3m2!1sid!2sid!4v1721328800800!5m2!1sid!2sid"
                width="100%" height="450" style="border:0; border-radius: 10px" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div> --}}
        
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
