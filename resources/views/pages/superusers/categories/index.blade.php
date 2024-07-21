<?php

use function Livewire\Volt\{state, rules, computed, usesPagination, uses};
use App\Models\Category;
use function Laravel\Folio\name;
use Jantinnerezo\LivewireAlert\LivewireAlert;

uses([LivewireAlert::class]);

name('categories.index');

state(['name', 'categoryId']);
rules(['name' => 'required|min:3|string']);

usesPagination(theme: 'bootstrap');

$categories = computed(fn() => Category::latest()->paginate(10));

$save = function (Category $category) {
    $validate = $this->validate();

    if ($this->categoryId == null) {
        $category->create($validate);
    } else {
        $categoryUpdate = Category::find($this->categoryId);
        $categoryUpdate->update($validate);
    }
    $this->reset('name');
    $this->flash(
        'success',
        'Proses Berhasil',
        [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ],
        '/superusers/categories',
    );
};

$edit = function (Category $category) {
    $category = Category::find($category->id);
    $this->categoryId = $category->id;
    $this->name = $category->name;
};

$destroy = function (Category $category) {
    $category->delete();
    $this->reset('name');
    $this->flash(
        'success',
        'Proses Berhasil',
        [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
            'text' => '',
        ],
        '/superusers/categories',
    );
};
?>


<x-admin-layout>
    <div>
        <x-slot name="title">Kategori Produk</x-slot>

        @volt
            <div>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Beranda</a>
                        </li>
                        <li class="breadcrumb-item active">Data Kategori</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-header">
                        <form wire:submit="save">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Kategori
                                    Produk</label>
                                <input type="text" class="form-control" wire:model="name" id="name"
                                    aria-describedby="helpId" placeholder="Masukkan kategori baru / edit" />

                                @error('name')
                                    <small id="helpId" class="form-text text-danger">{{ $message }}</small>
                                @enderror
                                <div class="row justify-content-between">
                                    <div class="col mt-3">
                                        <button type="reset" class="btn btn-danger">
                                            Reset
                                        </button>

                                    </div>
                                    <div class="col mt-3 text-end">
                                        <button type="submit" class="btn btn-primary">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="card-body">
                        <div class="table-responsive border rounded">
                            <table class="table text-center text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($this->categories as $no => $category)
                                        <tr>
                                            <td>{{ ++$no }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <a wire:click='edit({{ $category->id }})'
                                                    class="btn btn-sm btn-warning text-white ">Edit</a>

                                                <button wire:loading.attr='disabled'
                                                    wire:click='destroy({{ $category->id }})' class="btn btn-sm btn-danger">
                                                    Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            <div class="mx-3">
                                {{ $this->categories->links() }}
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @endvolt

    </div>
</x-admin-layout>
