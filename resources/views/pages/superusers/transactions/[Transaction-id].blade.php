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

$confirm = function () {
    $this->transaction->update(['status' => 'DIKONFIRMASI']);
};

$inUse = function () {
    $this->transaction->update(['status' => 'DALAM_PENGGUNAAN']);
};

$returned = function () {
    $this->transaction->update(['status' => 'DIKEMBALIKAN']);
};

$cancelled = function () {
    $this->transaction->update(['status' => 'BATAL']);
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
                        <button wire:loading.attr='disabled' class="btn btn-primary" wire:click="confirm">TERIMA</button>
                    @elseif($transaction->status === 'DIKONFIRMASI')
                        <button wire:loading.attr='disabled' class="btn btn-primary" wire:click="confirm">TERIMA</button>
                    @endif

                    <button wire:loading.attr='disabled' class="btn btn-danger" wire:click="cancelled">BATAL</button>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="invoice">
                        <div class="invoice overflow-auto">
                            <div style="min-width: 600px">
                                <header>
                                    <div class="row">
                                        <div class="col">
                                            <a href="javascript:;">
                                                <img src="assets/images/logo-icon.png" width="80" alt="">
                                            </a>
                                        </div>
                                        <div class="col company-details">
                                            <h2 class="name fw-bolder text-primary">
                                                {{ $transaction->status }}
                                            </h2>
                                        </div>
                                    </div>
                                </header>
                                <main>
                                    <div class="row contacts">
                                        <div class="col invoice-to">
                                            <div class="text-gray-light">
                                                FAKTUR KE:
                                            </div>
                                            <h2 class="to fw-bolder">
                                                {{ $transaction->user->name }}
                                            </h2>
                                            <div class="address">
                                                {{ $transaction->user->phone_number }}
                                            </div>
                                            <div class="email"><a href="mailto:{{ $transaction->user->email }}">
                                                    {{ $transaction->user->email }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col invoice-details">
                                            <h1 class="invoice-id">
                                                {{ $transaction->invoice }}
                                            </h1>
                                            <div class="date">Tanggal Faktur: {{ $transaction->created_at }}</div>
                                        </div>
                                    </div>
                                    <div class="table-responsive border rounded-3">
                                        <table class="table table-hover text-center table-borderless">
                                            <thead class="border-bottom">
                                                <tr>
                                                    <th>MOBIL</th>
                                                    <th>TANGGAL SEWA</th>
                                                    <th>DURASI</th>
                                                    <th>HARGA</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="border-bottom">
                                                    <td>
                                                        {{ $transaction->car->name }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->rent_date }}
                                                    </td>
                                                    <td>
                                                        {{ $transaction->duration }} Hari
                                                    </td>
                                                    <td>
                                                        {{ $transaction->formatRupiah($transaction->car->price) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="3"></td>
                                                    <td>
                                                        {{ $transaction->formatRupiah($transaction->car->price * $transaction->duration) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>SOPIR</td>
                                                    <td>
                                                        {{ $transaction->with_driver == 0 ? '-' : 'Rp ' . number_format(200000, 0, ',', '.') }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>TOTAL</td>
                                                    <td>
                                                        {{ $transaction->formatRupiah($transaction->total) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </main>

                            </div>
                            <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                            <div></div>
                        </div>
                    </div>
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
