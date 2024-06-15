<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state};

name('carId');

state(['car']);

?>

<x-guest-layout>
    @include('layouts.single-product')
    @volt
        <div>
            <div class="main-banner" id="top">
                <div class="container mt-2 mb-3">
                    <div class="no-gutters ">
                        <div class="card">
                            <div class="demo">
                                <ul id="lightSlider">
                                    @foreach ($car->carImages as $item)
                                        <li data-thumb="{{ $item->image_path }}">
                                            <img src="{{ $item->image_path }}" />
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    @endvolt
</x-guest-layout>
