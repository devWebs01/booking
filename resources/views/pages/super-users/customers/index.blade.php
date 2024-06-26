<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\User;

name('customers.index');

usesPagination(theme: 'bootstrap');

state(['search'])->url();

$users = computed(function () {
    if ($this->search == null) {
        return User::query()->where('role', 'customer')->latest()->paginate(10);
    } else {
        return User::where(function ($query) {
            $query
                ->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $this->search . '%');
        })
            ->where('role', 'customers')
            ->latest()
            ->paginate(10);
    }
});

?>
<x-admin-layout>
    <x-slot name="title">Data Admin</x-slot>

    @volt
        <div>
            <x-alert on="status">
            </x-alert>
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive rounded">
                        <table class="table table-hover display border  text-nowrap text-center">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Identitas</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telp</th>
                                    <th>Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($this->users as $no => $item)
                                    <tr>
                                        <td>{{ ++$no }}.</td>
                                        <td>
                                            {{-- <img src="{{ Storage::url($item->identity) }}" class="rounded" alt="..."> --}}
                                            <a href="{{ $item->identify }}" data-fancybox data-caption="Single image">
                                                <img src="{{ $item->identify }}" class="img rounded-circle" width="30px"
                                                    height="30px" alt="...">
                                            </a>
                                        </td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td>{{ $item->address }}</td>
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
