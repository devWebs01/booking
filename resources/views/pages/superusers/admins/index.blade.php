<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\User;

name('admin.index');
usesPagination(theme: 'bootstrap');

state(['search'])->url();

$users = computed(function () {
    if ($this->search == null) {
        return User::query()->where('role', 'admin')->latest()->paginate(10);
    } else {
        return User::where(function ($query) {
            $query
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $this->search . '%');
        })
            ->where('role', 'admin')
            ->latest()
            ->paginate(10);
    }
});

$deleted = function (User $user) {
    $user->delete();

    $this->dispatch('status');
};

?>
<x-admin-layout>
    <x-slot name="title">Data Admin</x-slot>

    @volt
        <div>
            <x-alert on="status">
            </x-alert>
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-between gap-2">
                        <div class="col-md">
                            <a wire:navigate class="btn btn-primary" href="{{ route('admin.create') }}" role="button">Tambah
                                Admin</a>
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
                                    <th>Email</th>
                                    <th>Telp</th>
                                    <th>Tombol</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->users as $no => $item)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td>
                                            <div class="d-flex gap-2 justify-content-center">
                                                <a type="button" class="btn btn-warning btn-sm"
                                                    href="{{ route('admin.edit', ['user' => $item->id]) }}" wire:navigate>
                                                    Edit
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm"
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
                        {{ $this->users->links() }}
                    </div>
                </div>
            </div>
        </div>
    @endvolt

</x-admin-layout>
