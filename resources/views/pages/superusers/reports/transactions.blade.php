<?php

use function Laravel\Folio\name;
use function Livewire\Volt\{state};
use App\Models\Transaction;

name('reports.transactions');

state([
    'transactions' => Transaction::get(),
]);
?>

<x-admin-layout>
    <x-slot name="title"></x-slot>
    @include('layouts.report')
    @volt
        <div>
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Position</th>
                        <th>Office</th>
                        <th>Age</th>
                        <th>Start date</th>
                        <th>Salary</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Tiger Nixon</td>
                        <td>System Architect</td>
                        <td>Edinburgh</td>
                        <td>61</td>
                        <td>2011-04-25</td>
                        <td>$320,800</td>
                    </tr>
                </tbody>
            </table>
        </div>
    @endvolt
</x-admin-layout>
