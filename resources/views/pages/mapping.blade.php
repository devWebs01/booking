<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\Category;

name('mapping');

state([
    'categories' => fn() => Category::with('cars')->get(),
    // 'getRental' => fn() => Rental::all(),
]);

?>
<x-guest-layout>
    <x-slot name="title">Mapping Pages</x-slot>
    @include('layouts.leaflet')

    @volt
    <div>
        <div class="container-fluid">
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

</x-guest-layout>
