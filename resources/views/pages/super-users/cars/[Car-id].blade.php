<?php
use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\car;

name('cars.edit');

state(['car']);

?>
<x-admin-layout>
    <x-slot name="title">{{ $car->name }}</x-slot>

    @volt
        <div>

        </div>
    @endvolt

</x-admin-layout>
