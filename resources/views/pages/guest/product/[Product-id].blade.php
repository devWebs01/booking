<?php

use function Laravel\Folio\name;
use function Livewire\Volt\{state, on, rules};
use App\Models\shop;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

name('product-detail');

state([
    'user_id' => fn() => auth()->user()->id ?? null,
    'product_id' => fn() => $this->product->id,
    'condition' => false, // ganti false
    'duration' => 1,
    'with_driver' => false,
    'description',
    'rent_date',
    'product',
    'total',
    'price_product',
]);

rules([
    'user_id' => ['required', 'exists:users,id'],
    'product_id' => ['required', 'exists:products,id'],
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

$calculateSubTotal = function () {
    $total = 0;

    if ($this->with_driver == 1) {
        $driver = 200000;
    } else {
        $driver = 0;
    }

    $subTotal = $this->product->price * $this->duration;
    $total = $subTotal + $driver;
    return $total;
};

$rentproduct = function () {
    if (Auth::check()) {
        $validate = $this->validate();

        $additionalData = [
            'price_product' => $this->product->price,
            'price_driver' => $this->with_driver ? 200000 : 0,
            'subtotal' => $this->calculateSubTotal(),
        ];

        Transaction::create(array_merge($validate, $additionalData));
        $this->redirectRoute('succesfully');
    } else {
        $this->redirect('/login');
    }
};
?>

<x-guest-layout>
    <x-slot name="title">{{ $product->name }}</x-slot>


    @volt
        <div>
            <section class="pb-5">
                <div class="container-fluid">
                    <div class="mb-3 justify-content-center text-center">
                        @if ($product->imageProducts->isNotEmpty())
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner">
                                    @foreach ($product->imageProducts as $no => $item)
                                        <div class="carousel-item {{ ++$no == 1 ? 'active' : '' }}">
                                            <img style="width: 100%; height: auto; margin: auto;"
                                                src="{{ Storage::url($item->image_path) }}" />
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                    data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        @else
                            <img src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg"
                                class="img-fluid" alt="image" />
                        @endif
                    </div>

                    <div class="row gx-5">
                        <div class="col-lg-6">
                            <div class="ps-lg-3 text-break">
                                <small class="fw-bold" style="color: #f35525;">{{ $product->category->name }}</small>
                                <h1 class="title text-dark fw-bold">
                                    {{ $product->name }}
                                </h1>

                                <div class="my-3">
                                    <span class="h5 fw-bold">
                                        {{ 'Rp. ' . Number::format($product->price, locale: 'id') }}
                                    </span>
                                </div>

                                <div class="row">
                                    <dt class="col-5 mb-2">
                                        Transmisi
                                    </dt>
                                    <dd class="col-7 mb-2">
                                        {{ $product->transmission }}
                                    </dd>

                                    <dt class="col-5 mb-2">
                                        Kursi
                                    </dt>
                                    <dd class="col-7 mb-2">
                                        {{ $product->capacity }}
                                    </dd>

                                    <dt class="col-5 mb-2">
                                        Bagasi
                                    </dt>
                                    <dd class="col-7 mb-2">
                                        {{ $product->space }} Koper
                                    </dd>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3" style="overflow-wrap: anywhere;">
                                {!! $product->description !!}
                            </div>
                        </div>

                    </div>

                    <section>
                        @if (auth()->user()->role == 'customer')
                            @if ($condition == false)
                                <!-- Tombol untuk mengaktifkan status -->
                                <div class="d-grid mb-5">
                                    <button wire:click="turnOnCondition" class="btn btn-primary ">
                                        Rental Mobil Ini
                                    </button>
                                </div>
                            @else
                                <div class="d-grid mb-5">
                                    <button wire:click="turnOffCondition" class="btn btn-danger ">
                                        Batal Rental
                                    </button>
                                </div>
                                @include('pages.guest.product.form-rent')
                            @endif
                        @endif
                    </section>
                </div>
            </section>

        </div>
    @endvolt
</x-guest-layout>
