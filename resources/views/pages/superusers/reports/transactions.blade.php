<?php

use function Livewire\Volt\{state, computed, usesPagination, rules};
use function Laravel\Folio\name;
use App\Models\transaction;

name('reports.transactions');

state([
    'transactions' => fn() => transaction::latest()->get(),
]);

$export = function () {};

?>

<x-admin-layout>
    <x-slot name="title">Laporan Transaksi</x-slot>
    @include('layouts.report')

    @volt
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Laporan</a>
                    </li>
                    <li class="breadcrumb-item active">Transaksi</li>
                </ol>
            </nav>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="display table wrap" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pelanggan</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Rental</th>
                                    <th>Tanggal Berakhir</th>
                                    <th>Supir</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->transactions as $no => $item)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->rent_date }}</td>
                                        <td>{{ Carbon\Carbon::parse($item->rent_date)->addDays($item->duration)->format('Y-M-d') }}
                                        </td>
                                        <td>
                                            {{ $item->formatRupiah($item->price_driver) }}

                                        </td>
                                        <td>
                                            {{ $item->formatRupiah($item->price_product * $item->duration + $item->price_driver) }}
                                        </td>
                                        <td>
                                            {{ $item->formatRupiah($item->price_product * $item->duration + $item->price_driver) }}
                                        </td>
                                        <td>
                                            <span class="badge bg-primary py-2">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endvolt
</x-admin-layout>
