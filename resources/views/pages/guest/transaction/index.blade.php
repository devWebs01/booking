<?php
use function Laravel\Folio\{name, middleware};
use function Livewire\Volt\{state};
use App\Models\Transaction;

name('transaction.guest');
middleware(['auth']);

state([
    'transactions' => fn() => Transaction::where('user_id', auth()->user()->id)->get(),
]);

?>

<x-guest-layout>
    <x-slot name="title">Transaksi Rental Mobil</x-slot>
    @volt
        <div>
            <div class="container-fluid row mt-5 mb-3">
                <div class="col-lg-6">
                    <h1 id="font-custom" class="display-1 fw-bold">
                        Transaksi Rental <br> Mobil
                    </h1>
                </div>
                <div class="col-lg-6 mt-lg-0 align-content-center">
                    <p>
                        Temukan kemudahan dalam menyewa mobil dengan
                        proses yang cepat dan aman. Pilih mobil sesuai kebutuhan Anda dan nikmati perjalanan tanpa kendala.
                    </p>
                </div>
            </div>
            <div class="rounded border">
                <div class="table-responsive p-3">
                    <table class="table table-hover text-nowrap text-center">
                        <thead>
                            <tr>
                                <th>No. </th>
                                <th>Nama</th>
                                <th>Transmisi</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $no => $item)
                                <tr>
                                    <td>{{ ++$no }}.</td>
                                    <td>{{ $item->car->name }}</td>
                                    <td>{{ $item->car->transmission }}</td>
                                    <td>
                                        <span class="badge bg-warning">
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
    @endvolt
</x-guest-layout>
