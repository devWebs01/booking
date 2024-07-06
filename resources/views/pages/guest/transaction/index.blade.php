<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\Transaction;

name('transaction.index');
usesPagination(theme: 'bootstrap');

$transactions = computed(function () {
    return Transaction::where('user_id', Auth()->user()->id)->paginate(10);
});
?>

<x-guest-layout>
    <x-slot name="title">Transaksi Rental Mobil</x-slot>
    @volt
        <div>
            <div class="rounded border mt-5">
                <div class="table-responsive">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Transmisi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->transactions as $no => $item)
                                <tr>
                                    <td>{{ ++$no }}.</td>
                                    <td>{{ $item }}</td>
                                    <td>{{ $item->transmission }}</td>
                                    <td>
                                        <span class="badge bg-{{ $item->status == 1 ? 'success' : 'warning' }}">
                                            {{ $item->status == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}
                                        </span>

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $this->transactions->links() }}
                </div>
            </div>
        </div>
    @endvolt
</x-guest-layout>
