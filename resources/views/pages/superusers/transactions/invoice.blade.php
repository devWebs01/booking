<div class="card">
    <div class="card-body">
        <div id="invoice">
            <div class="invoice overflow-auto">
                <div style="min-width: 600px">
                    <header>
                        <div class="row">
                            <div class="col">
                                <a href="javascript:;">
                                    <img src="assets/images/logo-icon.png" width="80" alt="">
                                </a>
                            </div>
                            <div class="col company-details">
                                <h2 class="name fw-bolder text-primary">
                                    {{ $transaction->status }}
                                </h2>
                            </div>
                        </div>
                    </header>
                    <main>
                        <div class="row contacts">
                            <div class="col invoice-to">
                                <div class="text-gray-light">
                                    FAKTUR KE:
                                </div>
                                <h2 class="to fw-bolder">
                                    {{ $transaction->user->name }}
                                </h2>
                                <div class="address">
                                    {{ $transaction->user->phone_number }}
                                </div>
                                <div class="email">
                                    <a href="mailto:{{ $transaction->user->email }}">
                                        {{ $transaction->user->email }}
                                    </a>
                                </div>
                            </div>
                            <div class="col invoice-details">
                                <h1 class="invoice-id">
                                    {{ $transaction->invoice }}
                                </h1>
                                <ul class="date">
                                    <li>
                                        Tanggal Faktur:
                                    </li>
                                    @foreach ($transaction->datings as $item)
                                        <li>
                                            {{ '[' . $item->status . '] ' . $item->dateOfTransaction }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="table-responsive border rounded-3">
                            <table class="table table-hover text-center table-borderless">
                                <thead class="border-bottom">
                                    <tr>
                                        <th>MOBIL</th>
                                        <th>TANGGAL SEWA</th>
                                        <th>DURASI</th>
                                        <th>AKHIR SEWA</th>
                                        <th>TERLAMBAT</th>
                                        <th>HARGA</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-bottom">
                                        <td>
                                            {{ $transaction->product->name }}
                                        </td>
                                        <td>
                                            {{ $transaction->rent_date }}
                                        </td>
                                        <td>
                                            {{ $transaction->duration }} Hari
                                        </td>
                                        <td>
                                            {{ $rentEndDate->format('Y-M-d') }}
                                        </td>
                                        <td>
                                            {{ $daysLate }} HARI
                                        </td>
                                        <td>
                                            {{ $transaction->formatRupiah($transaction->price_product) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>HARGA SEWA</td>
                                        <td>
                                            {{ $transaction->formatRupiah($transaction->price_product * $transaction->duration) }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>SOPIR</td>
                                        <td>
                                            {{ $transaction->with_driver == 0 ? '-' : $transaction->formatRupiah(200000) }}
                                        </td>
                                    </tr>
                                    <tr class="border-bottom">
                                        <td colspan="3"></td>
                                        <td>SUBTOTAL</td>
                                        <td>
                                            {{ $transaction->formatRupiah($subtotal) }}
                                        </td>

                                        @if ($today->greaterThan($rentEndDate) == true && $transaction->status == 'DALAM_PENGGUNAAN')
                                            <td> + {{ $transaction->formatRupiah($lateFee) }}
                                                (DENDA)
                                            </td>
                                        @endif

                                    </tr>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td>TOTAL</td>
                                        <td>
                                            {{ $transaction->formatRupiah($total) }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </main>
                </div>

            </div>
        </div>
    </div>
</div>
