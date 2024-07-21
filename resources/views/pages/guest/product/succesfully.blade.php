<?php
use function Laravel\Folio\name;

name('succesfully');
?>

<x-guest-layout>
    <div>
        <section class="py-5 my-md-5">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-md-7">
                        <span class="text-muted">Proses Rental Mobil</span>
                        <h2 class="mb-3 display-5 fw-bold">BERHASIL</h2>
                        <p class="lead">
                            Kami mohon kesabaran sementara kami menunggu konfirmasi dari pihak admin. Pihak admin akan
                            segera meninjau dan memverifikasi detail rental mobil Anda. </p>
                        <div class="mx-auto d-flex justify-content-center">
                            <a class="btn btn-primary rounded" href="{{ route('transaction.guest') }}"
                                role="button">Ke Transaksi</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-guest-layout>
