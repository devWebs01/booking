<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\Transaction;
use App\Models\Car;

name('transactions.edit');

state([
    'car' => fn() => Car::find($this->transaction->car_id),
    'transaction',
]);

?>
<x-admin-layout>
    <x-slot name="title">Data Transaksi Rental</x-slot>

    @volt
        <div>
            <x-alert on="status">
            </x-alert>
            <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
                <div class="card-body px-4 py-3">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h4 class="fw-semibold mb-8">User Profile</h4>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a class="text-muted text-decoration-none" href="../main/index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item" aria-current="page">User Profile</li>
                                </ol>
                            </nav>
                        </div>
                        <div class="col-3">
                            <div class="text-center mb-n5">
                                <img src="https://bootstrapdemos.adminmart.com/modernize/dist/assets/images/breadcrumb/ChatBc.png"
                                    alt="modernize-img" class="img-fluid mb-n4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-show-tab" data-bs-toggle="pill" data-bs-target="#pills-show"
                        type="button" role="tab" aria-controls="pills-show" aria-selected="true">
                        Detail Transaksi
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-edit-tab" data-bs-toggle="pill" data-bs-target="#pills-edit"
                        type="button" role="tab" aria-controls="pills-edit" aria-selected="false">Edit Data</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-show" role="tabpanel" aria-labelledby="pills-show-tab"
                    tabindex="0">
                    @include('pages.superusers.transactions.show')
                </div>
                <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab" tabindex="0">

                </div>
            </div>

        </div>
    @endvolt

</x-admin-layout>
