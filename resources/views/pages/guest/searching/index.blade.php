<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\Rental;
use App\Models\Category;
use App\Models\Car;
use Carbon\Carbon;

name('geolocation');

usesPagination(theme: 'bootstrap');

state(['selectedDate', 'categoryId'])->url();
state([
    'firstRental' => fn() => Rental::first(),
    'categories' => fn() => Category::get(),
    'duration',
    'rent_date',
]);

$search = computed(function () {
    $selectedDate = $this->selectedDate;
    $categoryId = $this->categoryId;

    if (!$selectedDate) {
        return null; // Return an empty collection if no date is selected
    }

    return Car::when($categoryId !== 'all', function ($query) use ($categoryId) {
        $query->whereHas('category', function ($query) use ($categoryId) {
            $query->where('id', $categoryId);
        });
    })
        ->whereDoesntHave('transactions', function ($query) use ($selectedDate) {
            $query->where('rent_date', $selectedDate);
        })
        ->orWhereHas('transactions', function ($query) use ($selectedDate) {
            $query->where('rent_date', '<', $selectedDate)->where('duration', '<=', now()->diffInDays($selectedDate));
        })
        ->paginate(6);
});

?>
<x-guest-layout>
    <x-slot name="title">Mapping Pages</x-slot>
    {{-- @include('pages.guest.searching.geolocation') --}}

    @volt
        <div>
            <div class="container-fluid">
                <div class="rounded col-12 h-50 position-absolute top-0 start-0 bg-primary" style="z-index:-2;">
                </div>

                {{-- form search --}}
                <div class="row">
                    <div class="col-12 mt-5">
                        <div class="bg-white p-5 shadow rounded">
                            <h1 class="display-3 fw-bold mb-0">Jadwalkan <span class="text-primary">Sewa Mobil</span> mu
                            </h1>
                            <small>Kemanapun tujuannya, rental mobilnya tetap <span class="text-primary">
                                    {{ $firstRental->name }}</span>
                            </small>


                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="my-3">
                                    <label for="selectedDate" class="form-label">Tanggal</label>
                                    <input type="date" class="form-control form-control-lg"
                                        wire:model.live="selectedDate" id="selectedDate" aria-describedby="helpId"
                                        placeholder="selectedDate" wire:change="$set('categoryId', 'all')" />
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="my-3">
                                    <label for="categoryId" class="form-label">Pilih Kategori Mobilmu</label>
                                    <select class="form-select form-select-lg" wire:model.live="categoryId" id="categoryId">
                                        <option selected value="all">Select one</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- result search --}}
            <div class="container-fluid mt-4">
                <div class="row">
                    @if ($this->search() == null)
                        <div class="card">
                            <div class="card-body">
                                <h3 class="fw-bold text-center">Tidak ditemukan</h3>
                            </div>
                        </div>
                    @else
                        @foreach ($this->search() as $car)
                            <div class="col-md-6 mb-4">
                                <div class="card position-relative shadow">
                                    <div class="position-absolute z-index--1 me-10 me-xxl-0"
                                        style="right:-160px;top:-210px;">
                                        <img src="{{ asset('/front-end/assets/img/steps/bg.png') }}"
                                            style="max-width:550px;" alt="shape" />
                                    </div>
                                    <div class="card-body p-3">
                                        <img class="mb-4 mt-2 rounded-2 img"
                                            src="{{ Storage::url($car->carImages->first()->image_path) }}" alt="booking"
                                            height="300px" width="100%" style="object-fit: cover" />
                                        <div>
                                            <a href="{{ route('car-detail', ['car' => $car->id]) }}" class="fw-medium">
                                                {{ $car->name }} {{ $this->search()->count() }}</a>
                                            <p class="fs--1 mb-3 fw-medium">{{ $car->transmission }}
                                            </p>
                                            <div class="show-onhover position-relative">
                                                <div class="d-flex gap-3">
                                                    <!-- Tooltip untuk Koper -->
                                                    <button class="btn icon-item" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="{{ $car->space }} Koper">
                                                        <i class="fa-solid fa-car"></i>
                                                    </button>

                                                    <!-- Tooltip untuk Penumpang -->
                                                    <button class="btn icon-item" data-bs-toggle="tooltip"
                                                        data-bs-placement="top" title="{{ $car->capacity }} Penumpang">
                                                        <i class="fa-solid fa-suitcase-rolling"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if ($this->search())
                        <div class="row text-center">
                            {{ $this->search->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    @endvolt

</x-guest-layout>
