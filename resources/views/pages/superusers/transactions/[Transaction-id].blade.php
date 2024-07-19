<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, mount, on};
use App\Models\Transaction;
use App\Models\product;
use App\Models\Dating;
use Carbon\Carbon;

name('transactions.edit');

state([
    'product' => fn() => product::find($this->transaction->product_id),
    'rentEndDate',
    'transaction',
    'daysLate',
    'lateFee',
    'total',
    'today',
]);

on([
    'eventName' => function () {
        $transaction = Transaction::find($this->transaction->id);
        $this->transaction = $transaction;
    },
]);

mount(function () {
    $this->rentEndDate = Carbon::parse($this->transaction->rent_date)->addDays($this->transaction->duration);
    $this->today = Carbon::today();

    // Perhitungan keterlambatan dan biaya keterlambatan
    if ($this->today->greaterThan($this->rentEndDate)) {
        $this->daysLate = $this->today->diffInDays($this->rentEndDate);
        $this->lateFee = $this->daysLate * 100000; // Rp 100.000 per hari terlambat
    } else {
        $this->daysLate = 0;
        $this->lateFee = 0;
    }

    // Perhitungan total biaya
    $this->total = $this->transaction->price_product * $this->transaction->duration + $this->transaction->price_driver + $this->lateFee;
});

$confirm = function () {
    $this->transaction->update(['status' => 'DIKONFIRMASI']);
    Dating::create([
        'transaction_id' => $this->transaction->id,
        'dateOfTransaction' => today(),
        'status' => $this->transaction->status,
    ]);
};

$reschedule = function () {
    $this->transaction->update([
        'rent_date' => today()->format('Y-m-d'),
    ]);
    $this->dispatch('eventName');
};

$inUse = function () {
    $this->transaction->update(['status' => 'DALAM_PENGGUNAAN']);
    Dating::create([
        'transaction_id' => $this->transaction->id,
        'dateOfTransaction' => today(),
        'status' => $this->transaction->status,
    ]);
};

$finished = function () {
    $this->transaction->update(['status' => 'SELESAI']);
    Dating::create([
        'transaction_id' => $this->transaction->id,
        'dateOfTransaction' => today(),
        'status' => $this->transaction->status,
    ]);
};

$cancelled = function () {
    $this->transaction->update(['status' => 'BATAL']);
    Dating::create([
        'transaction_id' => $this->transaction->id,
        'dateOfTransaction' => today(),
        'status' => $this->transaction->status,
    ]);
};

?>
<x-admin-layout>
    <x-slot name="title">Data Transaksi Rental</x-slot>

    @volt
        <div>
            <x-alert on="status">
            </x-alert>
            <div class="card">
                <div class="card-header">
                    Tentukan tindakan selanjutnya:
                </div>
                <div class="card-body d-grid gap-2 d-md-flex justify-content-md-end">

                    @if ($transaction->status === 'MENUNGGU_KONFIRMASI')
                        @if ($today->greaterThan($rentEndDate))
                            <button wire:loading.attr='disabled' class="btn btn-primary" wire:click="reschedule">
                                JADWALKAN ULANG
                            </button>
                        @else
                            <button wire:loading.attr='disabled' class="btn btn-primary" wire:click="confirm">
                                KONFIRMASI
                            </button>
                        @endif
                    @elseif($transaction->status === 'DIKONFIRMASI')
                        <button wire:loading.attr='disabled' class="btn btn-success" wire:click="inUse">
                            DIGUNAKAN
                        </button>
                    @elseif($transaction->status === 'DALAM_PENGGUNAAN' || $transaction->status === 'TERLAMBAT')
                        <button wire:loading.attr='disabled' class="btn btn-success" wire:click="finished">
                            SELESAI
                        </button>
                    @endif

                    <button wire:loading.attr='disabled'
                        class="btn btn-danger
                        {{ $transaction->status === 'BATAL' ||
                        $transaction->status === 'DALAM_PENGGUNAAN' ||
                        $transaction->status === 'TERLAMBAT' ||
                        $transaction->status === 'SELESAI'
                            ? 'd-none'
                            : '' }}"
                        wire:click="cancelled">BATAL</button>
                </div>
            </div>

            <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        type="button" role="tab" aria-controls="pills-home" aria-selected="true">INVOICE</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-edit-tab" data-bs-toggle="pill" data-bs-target="#pills-edit"
                        type="button" role="tab" aria-controls="pills-edit" aria-selected="false">EDIT</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-information-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-information" type="button" role="tab" aria-controls="pills-information"
                        aria-selected="false">INFORMASI</button>
                </li>

            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    @include('pages.superusers.transactions.invoice')
                </div>
                <div class="tab-pane fade" id="pills-edit" role="tabpanel" aria-labelledby="pills-edit-tab" tabindex="0">
                    @include('pages.superusers.transactions.edit')

                </div>
                <div class="tab-pane fade" id="pills-information" role="tabpanel" aria-labelledby="pills-information-tab"
                    tabindex="0">
                    @include('pages.superusers.transactions.information')

                </div>

            </div>


        </div>
    @endvolt
    <style>
        #invoice {
            padding: 0px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #0d6efd
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #0d6efd
        }

        .invoice main {
            padding-bottom: 50px
        }

        @media print {
            .invoice {
                font-size: 11px !important;
                overflow: hidden !important
            }
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #0d6efd;
            background: #e7f2ff;
            padding: 10px;
        }
    </style>

</x-admin-layout>
