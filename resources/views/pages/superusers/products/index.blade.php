<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\product;

name('products.index');
usesPagination(theme: 'bootstrap');

state(['search'])->url();

$products = computed(function () {
    if ($this->search == null) {
        return product::query()->latest()->paginate(10);
    } else {
        return product::where(function ($query) {
            $query
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('category_id', 'LIKE', '%' . $this->search . '%')
                ->orWhere('transmission', 'LIKE', '%' . $this->search . '%');
        })
            ->latest()
            ->paginate(10);
    }
});

$deleted = function (product $product) {
    $product->delete();

    $this->dispatch('status');
};

?>
<x-admin-layout>
    <x-slot name="title">Data Mobil</x-slot>

    @volt
        <div>
            <x-alert on="status">
            </x-alert>
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between gap-2">
                        <div class="col-md">
                            <a wire:navigate class="btn btn-primary" href="{{ route('products.create') }}" role="button">Tambah
                                Mobil</a>
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
                        <table class="table table-hover display border  text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Transmisi</th>
                                    <th>Status</th>
                                    <th>Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->products as $no => $item)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->transmission }}</td>
                                        <td>
                                            <span class="badge bg-{{ $item->status == 1 ? 'success' : 'warning' }} py-2">
                                                {{ $item->status == 1 ? 'AKTIF' : 'TIDAK AKTIF' }}
                                            </span>

                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group"
                                                aria-label="Small button group">
                                                <a type="button" class="btn btn-warning "
                                                    href="{{ route('products.edit', ['product' => $item->id]) }}" wire:navigate>
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger "
                                                    wire:click='deleted({{ $item->id }})'
                                                    wire:confirm.prompt="Yakin Ingin Menghapus?\n\nTulis 'hapus' untuk konfirmasi!|hapus"
                                                    wire:loading.attr="disabled">
                                                    Hapus
                                                </button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $this->products->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-admin-layout>
