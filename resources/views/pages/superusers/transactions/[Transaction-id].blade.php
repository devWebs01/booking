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
    $this->transaction->update(['status' => 'DIGUNAKAN']);
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
            @if ($transaction->status === 'DIPESAN')
                <div class="card">
                    <div class="row card-body justify-content-between">
                        <h5 class="col-md">Tentukan Tindakan Selanjutnya</h5>
                        <div class="col-md text-md-end align-self-center">
                            <button
                                wire:confirm.prompt="Yakin Ingin Mengkonfirmasi Peny ewaan Mobil?\n\nTulis 'terima' untuk konfirmasi!|terima"
                                wire:loading.attr='disabled' class="btn btn-primary" wire:click="confirm">TERIMA</button>
                            <button
                                wire:confirm.prompt="Yakin Ingin Membatalkan Penyewaan Mobil?\n\nTulis 'batal' untuk konfirmasi!|batal"
                                wire:loading.attr='disabled' class="btn btn-danger" wire:click="cancelled">BATAL</button>
                        </div>
                    </div>
                </div>
            @endif
            @include('pages.superusers.transactions.show')
        </div>
    @endvolt

</x-admin-layout>
