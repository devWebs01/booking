<?php

use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\Rental;

name('car-detail');

state(['car']);

?>

<x-guest-layout>
    <x-slot name="title">{{ $car->name }}</x-slot>

    @volt
    <div>
        <section class="pb-5">
            <div class="container-fluid">
                <div class="row gx-5">
                    <aside class="col-lg-6">
                        <div class="rounded-4 mb-3 d-flex justify-content-center">
                            <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image"
                                href="{{ Storage::url($car->carImages->first()->image_path) }}">
                                <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit"
                                    src="{{ Storage::url($car->carImages->first()->image_path) }}" />
                            </a>
                        </div>

                    </aside>
                    <main class="col-lg-6">
                        <div class="ps-lg-3 text-break">
                            <small class="fw-bold" style="color: #f35525;">{{ $car->category->name }}</small>
                            <h1 class="title text-dark fw-bold">
                                {{ $car->name }}
                            </h1>

                            <div class="my-3">
                                <span class="h5 fw-bold">
                                    {{ 'Rp. ' . Number::format($car->price, locale: 'id') }}
                                </span>
                            </div>

                            <p class="mb-3">
                                {{ $car->description }}
                            </p>

                            <div class="row">
                                <dt class="col-5 mb-2">
                                    Transmisi
                                </dt>
                                <dd class="col-7 mb-2">
                                    {{ $car->transmission }}
                                </dd>

                                <dt class="col-5 mb-2">
                                    Kursi
                                </dt>
                                <dd class="col-7 mb-2">
                                    {{ $car->capacity }}
                                </dd>

                                <dt class="col-5 mb-2">
                                    Bagasi
                                </dt>
                                <dd class="col-7 mb-2">
                                    {{ $car->space }} Koper
                                </dd>

                            </div>
                        </div>
                    </main>
                </div>
                @endvolt
</x-guest-layout>
