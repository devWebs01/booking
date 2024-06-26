<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, usesFileUploads};
use App\Models\Category;
use App\Models\Car;

name('cars.create');

usesFileUploads();

state([
    'categories' => fn() => Category::get(),
    'images' => [],
    'name',
    'price',
    'description',
    'capacity',
    'space',
    'category_id',
    'transmission',
    'status',
]);

$removeMe = fn($index) => array_splice($this->images, $index, 1);

$store = function (car $cari) {
    $validate = $this->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string|max:500',
        'capacity' => 'required|string|max:50',
        'space' => 'required|string|max:50',
        'category_id' => 'required|exists:categories,id',
        'transmission' => 'required|in:manual,automatic',
        'status' => 'required|boolean',
        'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    $car = Car::create($validate);

    foreach ($this->images as $image) {
        $imagePath = $image->store('car-images', 'public');

        CarImage::create([
            'car_id' => $car->id,
            'path' => $imagePath,
        ]);
    }

    $this->reset('name', 'price', 'description', 'capacity', 'space', 'category_id', 'transmission', 'status');
};

?>
<x-admin-layout>
    <x-slot name="title">Tambah Mobil</x-slot>

    @volt
        <div>
            @include('layouts.text-editor')
            <x-alert on="status">
            </x-alert>
            <div class="card">
                <div class="card-header">
                    <div class="alert alert-primary" role="alert">
                        <strong>Tambah Mobil</strong>
                        <p>Pada halaman tambah mobil, Anda dapat memasukkan informasi mobil baru, seperti merek, model,
                            tahun, warna, harga, dan spesifikasi lainnya.

                            'name',
                            'price',
                            'description',
                            'capacity',
                            'space',
                            'category_id',
                            'transmission',
                            'status'
                        </p>
                    </div>
                </div>

                <div class="card-body">
                    <form wire:submit="store">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                wire:model="name" id="name" aria-describedby="nameId" placeholder="Enter car name"
                                autofocus autocomplete="name" />
                            @error('name')
                                <small id="nameId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror"
                                        wire:model="status" id="status">
                                        <option selected>Select one</option>
                                        <option value="1">Aktif</option>
                                        <option value="0">Tidak Aktif</option>
                                    </select>
                                    @error('status')
                                        <small id="statusId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Harga</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror"
                                        wire:model="price" id="price" aria-describedby="priceId"
                                        placeholder="Enter car price" />
                                    @error('price')
                                        <small id="priceId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="capacity" class="form-label">Kapasitas Kursi</label>
                                    <input type="number" class="form-control @error('capacity') is-invalid @enderror"
                                        wire:model="capacity" id="capacity" aria-describedby="capacityId"
                                        placeholder="Enter car capacity" />
                                    @error('capacity')
                                        <small id="capacityId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="space" class="form-label">Bagasi</label>
                                    <input type="number" class="form-control @error('space') is-invalid @enderror"
                                        wire:model="space" id="space" aria-describedby="spaceId"
                                        placeholder="Enter car space" />
                                    @error('space')
                                        <small id="spaceId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="transmission" class="form-label">Transmisi</label>
                                    <select class="form-select @error('transmission') is-invalid @enderror"
                                        wire:model="transmission" id="transmission">
                                        <option selected>Select one</option>
                                        <option value="Manual/Automatic">Manual/Automatic</option>
                                        <option value="Manual">Manual</option>
                                        <option value="Automatic">Automatic</option>
                                    </select>
                                    @error('transmission')
                                        <small id="transmissionId" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Kategori</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror"
                                        wire:model="category_id" id="category_id">
                                        <option selected>Select one</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small id="category_id" class="form-text text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Deksripsi Mobil</label>
                            <textarea wire:ignore class="form-control @error('description') is-invalid @enderror" wire:model="description"
                                id="editor" rows="3"></textarea>

                            @error('description')
                                <small id="descriptionId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Upload Gambar</label>
                            <input multiple type="file" class="form-control @error('images') is-invalid @enderror"
                                wire:model="images" id="images" aria-describedby="imagesId"
                                placeholder="Enter car images" autofocus autocomplete="images" />
                            @error('images.*')
                                <small id="imagesId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            @foreach ($images as $image)
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}">
                                    <div wire:key="{{ $loop->index }}">
                                        <button wire:click="removeMe({{ $loop->index }})">Remove</button>
                                    </div>
                                @endif
                            @endforeach
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
