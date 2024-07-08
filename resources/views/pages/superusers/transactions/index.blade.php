<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\Transaction;

name('transactions.index');

usesPagination(theme: 'bootstrap');

state(['search'])->url();

$transactions = computed(function () {
    if ($this->search == null) {
        return Transaction::query()->latest()->paginate(10);
    } else {
        return Transaction::query()
            ->join('users', 'transactions.user_id', '=', 'users.id')
            ->join('cars', 'transactions.car_id', '=', 'cars.id')
            ->where(function ($query) {
                $query
                    ->where('transactions.rent_date', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('cars.name', 'LIKE', '%' . $this->search . '%')
                    ->orWhere('transactions.status', 'LIKE', '%' . $this->search . '%');
            })
            ->select('transactions.*')
            ->latest()
            ->paginate(10);
    }
});

?>
<x-admin-layout>
    <x-slot name="title">Data Transaksi Rental</x-slot>

    @volt
        <div>
            <x-alert on="status">
            </x-alert>
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between gap-2">
                        <div class="col-md">
                            <a wire:navigate class="btn btn-primary" href="{{ route('transactions.create') }}"
                                role="button">Tambah Transaksi</a>
                            <span wire:loading class="spinner-border spinner-border-sm ms-3"></span>
                        </div>
                        <div class="col-md">
                            <input wire:model.live="search" type="search" class="form-control" name="search"
                                id="search" aria-describedby="helpId" placeholder="..." />
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table class="table table-hover display border text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Pelanggan</th>
                                    <th>Mobil</th>
                                    <th>Tanggal Rental</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->transactions as $no => $item)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>{{ $item->car->name }}</td>
                                        <td>{{ $item->rent_date }}</td>
                                        <td>
                                            <span class="badge bg-primary py-2">
                                                {{ $item->status }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('transactions.edit', ['transaction' => $item->id]) }}"
                                                class="btn btn-sm btn-primary">Detail</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $this->transactions->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-admin-layout>
