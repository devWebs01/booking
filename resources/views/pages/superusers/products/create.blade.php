<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, usesFileUploads};
use App\Models\Category;
use App\Models\product;
use App\Models\imageProduct;

name('products.create');

usesFileUploads();

state([
    'categories' => fn() => Category::get(),
    'name',
    'price',
    'description',
    'capacity',
    'space',
    'category_id',
    'transmission',
    'status',
    'images' => [],
]);

$store = function () {
    // dd($this->all());

    $validate = $this->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'capacity' => 'required|string|max:50',
        'space' => 'required|string|max:50',
        'category_id' => 'required|exists:categories,id',
        'transmission' => 'required|in:Manual,Automatic,Manual/Automatic',
        'status' => 'required|boolean',
        'images.*' => 'required|image',
    ]);

    $product = product::create($validate);

    foreach ($this->images as $image) {
        imageProduct::create([
            'product_id' => $product->id,
            'path' => $image->store('images'), // Pastikan $image adalah objek UploadedFile
        ]);
    }

    $this->reset('name', 'price', 'description', 'capacity', 'space', 'category_id', 'transmission', 'status');

    $this->redirectRoute('products.index');
};

?>
<x-admin-layout>
    <x-slot name="title">Tambah Mobil</x-slot>
    @include('layouts.text-editor')

    @volt
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="#">Beranda</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="#">Data Admin</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Data Admin</li>
                </ol>
            </nav>

            <div class="card">
                <div class="card-header">
                    <div class="alert alert-primary" role="alert">
                        <strong>Tambah Mobil</strong>
                        <p>Pada halaman tambah mobil, Anda dapat memasukkan informasi mobil baru, seperti merek, model,
                            tahun, warna, harga, dan spesifikasi lainnya.
                        </p>
                    </div>
                </div>
                @if ($errors)
                    @foreach ($errors->all() as $item)
                        <p>{{ $item }}</p>
                    @endforeach
                @endif

                <div class="card-body">
                    <form wire:submit="store">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Mobil</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" wire:model="name"
                                id="name" aria-describedby="nameId" placeholder="Enter car name" autofocus
                                autocomplete="name" />
                            @error('name')
                                <small id="nameId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" wire:model="status"
                                        id="status">
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
                                        placeholder="Enter product price" />
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
                                        placeholder="Enter product capacity" />
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
                                        placeholder="Enter product space" />
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

                        <div class="mb-3" wire:ignore>
                            <label for="description" class="form-label">Deksripsi Mobil</label>
                            <div class="border rounded" style="border-color: antiquewhite;">
                                <livewire:quill-text-editor wire:model.live="description" theme="bubble" />
                            </div>

                            @error('description')
                                <small id="descriptionId" class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <livewire:dropzone wire:model="images" :rules="['image', 'mimes:png,jpeg']" :multiple="true" />
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
