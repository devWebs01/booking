<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, rules};
use Illuminate\Validation\Rule;
use App\Models\User;

name('admin.edit');

state([
    'name' => fn() => $this->user->name,
    'email' => fn() => $this->user->email,
    'phone_number' => fn() => $this->user->phone_number,
    'user',
    'password',
]);

$edit = function () {
    $validateData = $this->validate([
        'name' => 'required|min:5',
        'email' => 'required|min:5|' . Rule::unique(User::class)->ignore($this->user->id),
        'password' => 'nullable|min:5',
        'phone_number' => 'required|digits_between:11,12|' . Rule::unique(User::class)->ignore($this->user->id),
    ]);

    $validateData['role'] = 'admin';

    $validateData['password'] = $this->user->password;
    User::whereId($this->user->id)->update($validateData);

    session()->flash('status', 'Akun Admin ' . $this->name . 'berhasil dibuat.');

    $this->reset('name', 'email', 'password', 'phone_number');

    $this->redirectRoute('admin.index', navigate: true);
};

?>
<x-admin-layout>
    <x-slot name="title">Edit Admin</x-slot>

    @volt
        <div>
            <div class="card">
                <div class="card-header">
                    <div class="alert alert-primary" role="alert">
                        <strong>Edit Admin {{ $user->name }}</strong>
                        <p>Pada halaman Edit Pengguna, Anda dapat menambahkan informasi pengguna baru seperti nama, email,
                            dan peran (admin).
                            <br>
                            <strong>Hanya masukkan kata sandi baru jika ingin mengubahnya.</strong>
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <form wire:submit="edit">
                        @csrf
                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        wire:model="name" id="name" aria-describedby="nameId"
                                        placeholder="Enter admin name" autofocus autocomplete="name" />
                                    @error('name')
                                        <small id="nameId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        wire:model="email" id="email" aria-describedby="emailId"
                                        placeholder="Enter admin email" />
                                    @error('email')
                                        <small id="emailId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">No. Telp</label>
                                    <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                                        wire:model="phone_number" id="phone_number" aria-describedby="phone_numberId"
                                        placeholder="Enter admin phone_number" />
                                    @error('phone_number')
                                        <small id="phone_numberId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Kata Sandi</label>
                                    <input type="text" class="form-control @error('password') is-invalid @enderror"
                                        wire:model="password" id="password" aria-describedby="passwordId"
                                        placeholder="Enter admin password" />
                                    @error('password')
                                        <small id="passwordId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endvolt

</x-admin-layout>
