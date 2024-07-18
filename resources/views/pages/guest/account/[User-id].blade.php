<?php

use function Laravel\Folio\name;
use function Livewire\Volt\{state, on, rules};
use App\Models\Rental;
use App\Models\Transaction;

name('user.account');

state([
    'name' => fn() => $this->user->name,
    'email' => fn() => $this->user->email,
    'phone_number' => fn() => $this->user->phone_number,
    'address' => fn() => $this->user->address,
    'identify' => fn() => $this->user->identify,
    'password',
    'user',
]);

?>

<x-guest-layout>
    <x-slot name="title">{{ $user->name }}</x-slot>

    @volt
        <div>
            <div class="container-fluid row mt-5 mb-3">
                <div class="col-lg-6">
                    <h1 id="font-custom" class="display-1 fw-bold">
                        Profile Akun <br> Anda
                    </h1>
                </div>
                <div class="col-lg-6 mt-lg-0 align-content-center">
                    <p>
                        Kelola informasi pribadi dan riwayat transaksi rental mobil Anda dengan mudah. Pastikan semua data
                        Anda selalu terupdate untuk memaksimalkan layanan kami.
                        <br>
                        'name',
                        'email',
                        'password',
                        'phone_number',
                        'role',
                        'address',
                        'identify',
                    </p>
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
                                            <img src="{{ $identify }}" alt="{{ $name }}" class="d-block rounded"
                                                height="100" width="100" id="uploadedAvatar">
                                        @else
                                            <div style="height: 100px;width: 100px"
                                                class="bg-secondary rounded border placeholder">
                                            </div>
                                        @endif
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                                <span class="d-none d-sm-block">Upload new photo</span>
                                                <i class="bx bx-upload d-block d-sm-none"></i>
                                                <input type="file" id="upload" class="account-file-input"
                                                    hidden="" accept="image/png, image/jpeg">
                                            </label>
                                            <button type="button"
                                                class="btn btn-outline-secondary account-image-reset mb-4">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Reset</span>
                                            </button>

                                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>
                                        </div>
                                    </div>
                                </div>
                                <hr class="my-0">
                                <div class="card-body">
                                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                                        <div class="row">
                                            <div class="mb-3 col-md-12">
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
                                                        name="phone_number" class="form-control" placeholder="202 555 0111">
                                                </div>
                                                @error('phone_number')
                                                    <small class="text-danger fw-bold">
                                                        {{ $message }}
                                                    </small>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
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
