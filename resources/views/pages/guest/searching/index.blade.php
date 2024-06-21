<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, rules, computed};
use App\Models\Rental;
use App\Models\Transaction;
use App\Models\Car;
use Carbon\Carbon;

name('geolocation');

state([
    'firstRental' => fn() => Rental::first(),
    'duration',
    'rent_date',
]);


$search =  computed(function () {

    $rentDate = Carbon::parse($this->rent_date);
        $duration = $this->duration;
        $endDate = $rentDate->copy()->addDays($duration);

    if (!$this->rent_date || !$this->duration) {
        return null;
    } else {
        // Cari mobil yang tersedia
        $availableCars = Car::whereDoesntHave('transactions', function ($query) use ($rentDate, $endDate) {
            $query->where(function ($query) use ($rentDate, $endDate) {
                $query->whereBetween('rent_date', [$rentDate, $endDate])
                    ->orWhereRaw("DATE_ADD(rent_date, INTERVAL duration DAY) BETWEEN ? AND ?", [$rentDate, $endDate])
                    ->orWhere(function ($query) use ($rentDate, $endDate) {
                        $query->where('rent_date', '<=', $rentDate)
                            ->whereRaw("DATE_ADD(rent_date, INTERVAL duration DAY) >= ?", [$endDate]);
                    });
            });
        })->get();

        return $availableCars;
    }
});

?>
<x-guest-layout>
    <x-slot name="title">Mapping Pages</x-slot>
    @include('pages.guest.searching.geolocation')

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

                        <div class="row mt-3">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="rent_date" class="form-label">Tanggal Sewa</label>
                                    <input type="date" class="form-control" id="rent_date"
                                        wire:model.live='rent_date' />
                                    @error('rent_date')
                                    <small id="rent_date" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <label for="duration" class="form-label">Durasi Sewa</label>
                                <div class="mb-3">
                                    <select id="duration" wire:model.live='duration' class="form-select">
                                        <option value="">Pilih Durasi</option>
                                        @for ($i = 1; $i <= 30; $i++) <option value="{{ $i }}">{{ $i }} Hari</option>
                                            @endfor
                                    </select>
                                    @error('duration')
                                    <small id="duration" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary rounded" type="button">
                                @if ($this->search() !== null)
                                {{ $this->search()->count() }}
                                @endif
                            </button>
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
                <div class="col-md-4 mb-4">
                    <div class="card position-relative shadow" style="max-width: 370px;">
                        <div class="position-absolute z-index--1 me-10 me-xxl-0" style="right:-160px;top:-210px;">
                            <img src="{{ asset('/front-end/assets/img/steps/bg.png') }}" style="max-width:550px;"
                                alt="shape" />
                        </div>
                        <div class="card-body p-3">
                            <img class="mb-4 mt-2 rounded-2 img object-fit-cover"
                                src="{{ Storage::url($car->carImages->first()->image_path) }}" alt="booking"
                                height="200px" width="100%" />
                            <div>
                                <a href="{{ route('car-detail', ['car' => $car->id]) }}" <a class="fw-medium">
                                    {{ $car->name }} {{$this->search()->count()}}</a>
                                <p class="fs--1 mb-3 fw-medium">{{ $car->transmission }}
                                </p>
                                <div class="show-onhover position-relative">
                                    <div class="d-flex gap-3">
                                        <!-- Tooltip untuk Koper -->
                                        <button class="btn icon-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ $car->space }} Koper">
                                            <i class="fa-solid fa-car"></i>
                                        </button>

                                        <!-- Tooltip untuk Penumpang -->
                                        <button class="btn icon-item" data-bs-toggle="tooltip" data-bs-placement="top"
                                            title="{{ $car->capacity }} Penumpang">
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
            </div>
        </div>
    </div>
    @endvolt

</x-guest-layout>
