<?php

use function Laravel\Folio\name;
use function Livewire\Volt\{state, on, rules};
use App\Models\Rental;
use App\Models\Transaction;

name('car-detail');

state([
    'user_id' => fn() => auth()->user()->id ?? null,
    'car_id' => fn() => $this->car->id,
    'condition' => false, // ganti false
    'duration' => 1,
    'with_driver' => false,
    'description',
    'rent_date',
    'car',
    'total',
    'price_car',
]);

rules([
    'user_id' => ['required', 'exists:users,id'],
    'car_id' => ['required', 'exists:cars,id'],
    'condition' => ['required', 'boolean'],
    'rent_date' => ['required', 'date', 'after:today'],
    'duration' => ['required', 'integer', 'min:1', 'max:30'],
    'with_driver' => ['required', 'boolean'],
]);

on([
    'toggleCondition' => function () {
        $this->condition = $this->condition;
    },
]);

$turnOnCondition = function () {
    $this->condition = true;
    $this->dispatch('toggleCondition');
};

$turnOffCondition = function () {
    $this->condition = false;
    $this->dispatch('toggleCondition');
};

$increment = fn() => $this->duration++;
$decrement = fn() => $this->duration--;

$calculateTotal = function () {
    $total = 0;

    if ($this->with_driver == 1) {
        $driver = 200000;
    } else {
        $driver = 0;
    }

    $subTotal = $this->car->price * $this->duration;
    $total = $subTotal + $driver;
    return $total;
};

$rentCar = function () {
    if (Auth::check()) {
        $validate = $this->validate();

        $additionalData = [
            'price_car' => $this->car->price,
            'price_driver' => $this->with_driver ? 200000 : 0,
            'total' => $this->calculateTotal(),
        ];

        Transaction::create(array_merge($validate, $additionalData));
        $this->redirectRoute('succesfully');
    } else {
        $this->redirect('/login');
    }
};
?>

<x-guest-layout>
    <x-slot name="title">{{ $car->name }}</x-slot>


    @volt
        <div>
            <section class="pb-5">
                <div class="container-fluid">
                    <div class="mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image"
                            href="{{ Storage::url($car->carImages->first()->image_path) }}">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="img-fluid"
                                src="{{ Storage::url($car->carImages->first()->image_path) }}" />
                        </a>
                    </div>
                    <input id="datepicker" wire:ignore width="276" />
                    <div class="row gx-5">
                        <div class="col-lg-6">
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
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3" style="overflow-wrap: anywhere;">
                                {!! $car->description !!}
                            </div>
                        </div>

                    </div>

                    <section>
                        @if ($condition == false)
                            <!-- Tombol untuk mengaktifkan status -->
                            <div class="d-grid mb-5">
                                <button wire:click="turnOnCondition" class="btn btn-primary rounded">
                                    Rental Mobil Ini
                                </button>
                            </div>
                        @else
                            <div class="d-grid mb-5">
                                <button wire:click="turnOffCondition" class="btn btn-danger rounded">
                                    Batal Rental
                                </button>
                            </div>
                            @include('pages.guest.car.form-rent')
                        @endif
                    </section>
                </div>
            </section>

        </div>
    @endvolt
</x-guest-layout>
