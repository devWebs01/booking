<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\Transaction;

name('transactions.create');

?>
<x-admin-layout>
    <x-slot name="title">Data Transaksi Rental</x-slot>

    @volt
        <div>
            <x-alert on="status">
            </x-alert>
            <div class="card">

            </div>
        </div>
    @endvolt

</x-admin-layout>
