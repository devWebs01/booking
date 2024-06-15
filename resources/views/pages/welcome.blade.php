<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\Car;

name('welcome');

state([
    'cars' => fn() => Car::with('carImages')->limit(6)->get(),
]);

?>

<x-guest-layout>
    <x-slot name="title">Welcome Page</x-slot>
    <section>
        <div class="bg-holder" style="background-image:url(assets/img/hero/hero-bg.svg);"></div>
        <!--/.bg-holder-->
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-md-5 col-lg-6 order-0 order-md-1 text-end">
                    <img class="pt-7 pt-md-0 hero-img" src="{{ asset('/front-end/assets/img/hero/hero-img.png') }}"
                        alt="hero-header" />
                </div>
                <div class="col-md-7 col-lg-6 text-md-start text-center py-6">
                    <h4 class="fw-bold text-danger my-3">JADOO, Teman Setia Perjalanmu</h4>
                    <h1 class="hero-title">Bepergian, nikmati, dan jalani hidup baru</h1>

                </div>
            </div>
        </div>
    </section>
    <section class="pt-5 pt-md-9" id="service">
        <div class="container-fluid">
            <div class="position-absolute z-index--1 end-0 d-none d-lg-block">
                <img src="{{ asset('/front-end/assets/img/category/shape.svg') }}" style="max-width: 200px"
                    alt="service" />
            </div>
            <div class="mb-7 text-center">
                <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Pilihan Terbaik Untuk Perjalanan
                </h3>
                <h5 class="text-secondary">
                    Kami mengerti bahwa setiap bisnis dan pribadi memiliki kebutuhan transportasi yang beragam. Oleh
                    karena itu, JADOO menawarkan berbagai layanan sewa kendaraan sebagai solusi untuk memenuhi kebutuhan
                    transportasi yang dapat disesuaikan dengan berbagai kebutuhan.
                </h5>
            </div>
            <div class="row">
                <div class="col-lg-3 col-sm-6 mb-6">
                    <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                        <div class="card-body p-xxl-5 p-4">
                            <img src="https://omnispace.blob.core.windows.net/strapi-prod/2022-09-09/TRAC_Personal_Leasing_7fa804e3f7.svg"
                                width="75" alt="Service" />
                            <h4 class="mb-3">Mobil Pilihan</h4>
                            <p class="mb-0 fw-medium">Nikmati perjalananmu dengan kenyamanan
                                terbaik.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-6">
                    <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                        <div class="card-body p-xxl-5 p-4">
                            <img src="https://omnispace.blob.core.windows.net/strapi-prod/2022-09-05/Mobile_f8f5d7256a.svg"
                                width="75" alt="Service" />
                            <h4 class="mb-3">Layanan Terbaik</h4>
                            <p class="mb-0 fw-medium">Pelayanan terbaik untuk memenuhi kebutuhan
                                mobilmu.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-6">
                    <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                        <div class="card-body p-xxl-5 p-4">
                            <img src="https://www.trac.astra.co.id/_next/image?url=https%3A%2F%2Fomnispace.blob.core.windows.net%2Fstrapi-prod%2F2024-05-14%2FBus_Rental_0f517411f2_4dbe2ad776.webp&w=1920&q=75"
                                width="75" alt="Service" />
                            <h4 class="mb-3">Pengalaman Lokal</h4>
                            <p class="mb-0 fw-medium">Nikmati kenyamanan perjalanan di
                                sekitar kota.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 mb-6">
                    <div class="card service-card shadow-hover rounded-3 text-center align-items-center">
                        <div class="card-body p-xxl-5 p-4">
                            <img src="https://omnispace.blob.core.windows.net/strapi-prod/2022-09-09/Group_802c8ffea1.svg"
                                width="75" alt="Service" />
                            <h4 class="mb-3">Servis Khusus</h4>
                            <p class="mb-0 fw-medium">Layanan yang disesuaikan dengan
                                kebutuhanmu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-5" id="destination">
        <div class="container-fluid">
            <div class="position-absolute start-100 bottom-0 translate-middle-x d-none d-xl-block ms-xl-n4">
                <img src="{{ asset('/front-end/assets/img/dest/shape.svg') }}" alt="destination" />
            </div>
            <div class="mb-7 text-center">
                <h5 class="text-secondary">Top Selling </h5>
                <h3 class="fs-xl-10 fs-lg-8 fs-7 fw-bold font-cursive text-capitalize">Top Destinations</h3>
            </div>
            @volt
            <div class="row">
                @foreach ($cars as $car)
                <div class="col-md-4 mb-4">
                    <div class="card position-relative shadow" style="max-width: 370px;">
                        <div class="position-absolute z-index--1 me-10 me-xxl-0" style="right:-160px;top:-210px;">
                            <img src="{{ asset('/front-end/assets/img/steps/bg.png') }}" style="max-width:550px;"
                                alt="shape" />
                        </div>
                        <div class="card-body p-3">
                            <img class="mb-4 mt-2 rounded-2 w-100"
                                src="{{ Storage::url($car->carImages->first()->image_path) }}" alt="booking" />
                            <div>
                                <h5 class="fw-medium">{{ $car->name }}</h5>
                                <p class="fs--1 mb-3 fw-medium">{{ $car->space }} | {{ $car->capacity }}</p>
                                <div class="icon-group mb-4">
                                    <span class="btn icon-item">
                                        <img src="{{ asset('/front-end/assets/img/steps/leaf.svg') }}" alt="" />
                                    </span>
                                    <span class="btn icon-item">
                                        <img src="{{ asset('/front-end/assets/img/steps/map.svg') }}" alt="" />
                                    </span>
                                    <span class="btn icon-item">
                                        <img src="{{ asset('/front-end/assets/img/steps/send.svg') }}" alt="" />
                                    </span>
                                </div>
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center mt-n1">
                                        <img class="me-3" src="{{ asset('/front-end/assets/img/steps/building.svg') }}"
                                            width="18" alt="building" /><span class="fs--1 fw-medium">24 people
                                            going</span>
                                    </div>
                                    <div class="show-onhover position-relative">
                                        <div class="card hideEl shadow position-absolute end-0 start-xl-50 bottom-100 translate-xl-middle-x ms-3"
                                            style="width: 260px;border-radius:18px;">
                                            <div class="card-body py-3">
                                                <div class="d-flex">
                                                    <div style="margin-right: 10px">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('/front-end/assets/img/steps/favorite-placeholder.png') }}"
                                                            width="50" alt="favorite" />
                                                    </div>
                                                    <div>
                                                        <p class="fs--1 mb-1 fw-medium">Ongoing </p>
                                                        <h5 class="fw-medium mb-3">Trip to rome</h5>
                                                        <h6 class="fs--1 fw-medium mb-2"><span>40%</span> completed
                                                        </h6>
                                                        <div class="progress" style="height: 6px;">
                                                            <div class="progress-bar" role="progressbar"
                                                                style="width: 40%;" aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><button class="btn">
                                            <img src="{{ asset('/front-end/assets/img/steps/heart.svg') }}" width="20"
                                                alt="step" /></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @endvolt
    </section>

</x-guest-layout>