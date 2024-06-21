<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, computed, usesPagination};
use App\Models\User;

name('super-user.index');
usesPagination(theme: 'bootstrap');

state([
    // 'users' => fn() => User::get(),
]);

$users = computed(function () {
    return User::paginate(10);
});
$deleted = function (User $user) {
    $user->delete();

    $this->dispatch('refresh-page');
};

?>
<x-admin-layout>
    <x-slot name="title">User Pages</x-slot>

    @volt
        <div class="table-responsive ">
            <table class="table table-hover display border rounded text-nowrap">
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
                                <div class="d-flex gap-5 justify-content-between">
                                    <button type="button" class="btn btn-primary btn-sm">
                                        Edit
                                    </button>
                                    <button type="button" class="btn btn-primary btn-sm"
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
    @endvolt

</x-admin-layout>
