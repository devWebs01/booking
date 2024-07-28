<x-admin-layout>
    @include('layouts.responsive')
    <x-slot name="title">Beranda Admin</x-slot>
    <div class="card mb-3">
        <div class="d-flex align-items-start row">
            <div class="col-sm-7">
                <div class="card-body">
                    <h5 class="card-title text-primary mb-3">Selamat Datang Kembali {{ auth()->user()->name }}! 🎉</h5>
                    <p class="mb-6">Kamu memiliki data rental yang perlu kamu cek, lihat segera!</p>
                </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
                <div class="card-body pb-0 px-0 px-md-6">
                    <img src="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/assets/img/illustrations/man-with-laptop.png"
                        height="175" class="scaleX-n1-rtl" alt="View Badge User">
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <p class="card-header">Ringkasan Transaksi</p>
        <div class="card-body">
            <div class="table-responsive rounded">
                <table wire:ignore id="example" class="table table-hover display border" style="width: 100%">
                    <thead>
                        <tr>
                            <th>Pelanggan</th>
                            <th>Mobil</th>
                            <th>Tanggal Rental</th>
                            <th>Status</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $no => $item)
                            <tr>
                                <td>{{ $item->user->name }}</td>
                                <td>{{ $item->product->name }}</td>
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
            </div>
        </div>
    </div>
</x-admin-layout>
