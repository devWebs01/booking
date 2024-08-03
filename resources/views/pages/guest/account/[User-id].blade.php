<?php

use function Laravel\Folio\name;
use function Livewire\Volt\{state, on, rules, uses, usesFileUploads};
use App\Models\Transaction;
use Jantinnerezo\LivewireAlert\LivewireAlert;

uses([LivewireAlert::class]);
usesFileUploads();

name('user.account');

state([
    'name' => fn() => $this->user->name,
    'email' => fn() => $this->user->email,
    'phone_number' => fn() => $this->user->phone_number,
    'address' => fn() => $this->user->address,
    'password' => '',
    'identify',
    'user',
]);

$save = function () {
    $user = Auth::user();

    $validated = $this->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $this->user->id,
        'phone_number' => 'required|string|unique:users,phone_number,' . $this->user->id,
        'address' => 'required|string|max:255',
        'password' => 'nullable|string|min:8',
        'identify' => 'nullable|file|max:2048', // validasi file maksimal 2MB
    ]);

    if (!empty($this->password)) {
        $validated['password'] = bcrypt($this->password);
    }

    if ($this->identify) {
        $identifyfile = $this->identify->store('public/identify');
        $validated['identify'] = $identifyfile;
    }

    $user->update($validated);

    $this->flash(
        'success',
        'Proses Berhasil',
        [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ],
        '/guest/account/' . $this->user->id,
    );
};

?>

<x-guest-layout>
    <x-slot name="title">{{ $user->name }}</x-slot>

    @volt
        <div>
            <div class="container-fluid row mt-5">
                <div class="col-lg-6">
                    <h1 id="font-custom" class="display-1 fw-bold">
                        Profile Akun <br> Anda
                    </h1>
                </div>
                <div class="col-lg-6 mt-lg-0 align-content-center">
                    <p>
                        Kelola informasi pribadi dan riwayat transaksi Shop mobil Anda dengan mudah. Pastikan semua data
                        Anda selalu terupdate untuk memaksimalkan layanan kami.
                    </p>
                </div>

                <div class="alert alert-primary {{ $user->identify == null && $user->address == null ?: 'd-none' }}"
                    role="alert">
                    <strong>Pemberitahuan</strong>
                    <ul class="list-unstyled">
                        <li class="{{ $user->identify == null ?: 'd-none' }}">Lengkapi Data KTP</li>
                        <li class="{{ $user->address == null ?: 'd-none' }}">Lengkapi Alamat Lengkap</li>
                    </ul>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <!-- Account -->
                                <div class="card-body">
                                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                                        @if ($identify)
                                            <img src="{{ $identify->temporaryUrl() }}" class="img rounded" ;
                                                style="object-fit: cover" alt="identify" height="490px" width="100%" />
                                        @elseif ($user->identify)
                                            <img src="{{ Storage::url($user->identify) }}" class="img rounded"
                                                style="object-fit: cover;" alt="identify" height="490px" width="100%" />
                                        @endif

                                    </div>
                                </div>
                                <hr class="my-0">
                                <div class="card-body">
                                    <form id="formAccountSettings" wire:submit.prevent='save'>
                                        @csrf
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Nama Lengkap</label>
                                                <input wire:model='name' class="form-control" type="text" id="firstName"
                                                    name="firstName" value="John" autofocus="">
                                                @error('name')
                                                    <small class="text-danger fw-bold">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="identify" class="form-label">KTP</label>
                                                <input wire:model='identify' class="form-control" type="file"
                                                    id="identify" name="identify" accept="image/png, image/jpeg">
                                                @error('name')
                                                    <small class="text-danger fw-bold">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input wire:model='email' class="form-control" type="email" id="email"
                                                    name="email" value="john.doe@example.com"
                                                    placeholder="john.doe@example.com">
                                                @error('email')
                                                    <small class="text-danger fw-bold">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label class="form-label" for="phone_number">Phone Number</label>
                                                <div class="input-group input-group-merge">
                                                    <span class="input-group-text">IND</span>
                                                    <input wire:model='phone_number' type="number" id="phone_number"
                                                        name="phone_number" class="form-control" placeholder="0897XXXXXXX">
                                                </div>
                                                @error('phone_number')
                                                    <small class="text-danger fw-bold">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="address" class="form-label">Alamat</label>
                                                <textarea class="form-control" wire:model='address' name="address" id="address" rows="3">
                                                    {{ $address }} Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis, iure.
                                                </textarea>
                                            </div>

                                            @error('address')
                                                <small class="text-danger fw-bold">
                                                    {{ $message }}
                                                </small>
                                            @enderror
                                        </div>

                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">SUBMIT</button>

                                        </div>
                                    </form>
                                </div>
                                <!-- /Account -->
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endvolt
</x-guest-layout>
