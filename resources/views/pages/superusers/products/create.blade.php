<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state, usesFileUploads, uses, rules};
use App\Models\Category;
use App\Models\Product;
use App\Models\imageProduct;
use Jantinnerezo\LivewireAlert\LivewireAlert;
uses(LivewireAlert::class); // Tambahkan trait LivewireAlert

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
    'status',
    'image' => [],
    'prevImage' => null,
]);

rules([
    'name' => 'required|string|max:255',
    'price' => 'required|numeric|min:0',
    'description' => 'required|string',
    'capacity' => 'required|string|max:50',
    'space' => 'required|string|max:50',
    'category_id' => 'required|exists:categories,id',
    'status' => 'required|boolean',
    'image.*' => 'required|image',
]);

$updatingImage = function ($value) {
    $this->prevImage = $this->image;
};

$updatedImage = function ($value) {
    $this->image = array_merge($this->prevImage, $value);
};

$removeItem = function ($key) {
    if (isset($this->image[$key])) {
        $file = $this->image[$key];
        $file->delete();
        unset($this->image[$key]);
    }

    $this->image = array_values($this->image);
};

$store = function () {
    $validate = $this->validate();

    $product = product::create($validate);

    foreach ($this->image as $item) {
        imageProduct::create([
            'product_id' => $product->id,
            'image_path' => $item->store('public/images'), // Pastikan $image adalah objek UploadedFile
        ]);
    }

    $this->reset('name', 'price', 'description', 'capacity', 'space', 'category_id', 'status');

    $this->flash(
        'success',
        'Proses Berhasil',
        [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ],
        '/superusers/products',
    );
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
                        <a href="#">Data Mobil</a>
                    </li>
                    <li class="breadcrumb-item active">Tambah Data Mobil</li>
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

                        <div class="card my-3 border-0">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="imageInput" class="form-label">
                                        Gambar Mobil
                                        <div wire:loading wire:target='image, removeItem'
                                            class="spinner-border spinner-border-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </label>
                                    <label for="imageInput"
                                        class="{{ $image ? (count($image) >= 5 ? 'd-none' : '') : '' }} w-100 zoom-in">
                                        <div id="dropZone"
                                            class="d-flex align-items-center justify-content-center flex-column">
                                            <p> <i class="bi bi-cloud-arrow-down"></i>
                                            </p>
                                            <small style="font-size: 17px;">Drop file here or click to upload</small>
                                            <input type="file" class="d-none" id="imageInput" wire:model.live="image"
                                                accept=".jpg,.jpeg" multiple>
                                        </div>
                                    </label>

                                    <!-- Error follow sosmed -->
                                    @error('image.*')
                                        <small id="imageId" class="form-text color-custom"> {{ $message }}
                                        </small>
                                    @enderror
                                </div>

                                @if (!empty($image))
                                    @foreach ($image as $key => $item)
                                        <div class="card my-2 zoom-in">
                                            <div class="card-body text-dark">
                                                <div class="hstack justify-content-between align-items-center">
                                                    <div class="me-2" style="font-size: 2rem; color: #777;">
                                                        <i class='bx bx-box fs-3'></i>
                                                    </div>
                                                    {{ Str::limit($item->getClientOriginalName(), 15, '...') }}
                                                    <a type="button"
                                                        wire:click.prevent='removeItem({{ json_encode($key) }})'>
                                                        <i class='bx bx-task-x fs-3'></i> </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                                <small class="form-text text-muted m-0">
                                    <strong>Upload File Maks 5 MB</strong> (format .jpg atau
                                    .jpeg)
                                </small>
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

    <style>
        #dropZone {
            border: 2px dashed #bbb;
            border-radius: 5px;
            padding: 50px;
            text-align: center;
            font-size: 21pt;
            font-weight: bold;
            font-family: Arial, sans-serif;
            color: #bbb;
        }


        @keyframes zoomIn {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        @keyframes zoomOut {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(0);
                opacity: 0;
            }
        }

        .zoom-in {
            animation: zoomIn 0.3s forwards;
        }

        .zoom-out {
            animation: zoomOut 0.3s forwards;
        }
    </style>

</x-admin-layout>
