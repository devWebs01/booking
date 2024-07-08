<div class="row gx-2">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <small class="fw-bolder" style="color: #f35525;">
                    Invoice
                </small>
                <h1 class="title text-dark fw-bolder">
                    {{ $transaction->status }}
                </h1>

                <div class="mb-3 mt-1">
                    <span class="h4 fw-bolder">
                        {{ $transaction->user->name }}
                    </span>
                </div>
                <div class="row">
                    <dt class="col-3 mb-2">
                        Tanggal
                    </dt>
                    <dd class="col-9 mb-2">
                        {{ $transaction->rent_date }}
                    </dd>

                    <dt class="col-3 mb-2">
                        Durasi
                    </dt>
                    <dd class="col-9 mb-2">
                        {{ $transaction->duration }} hari
                    </dd>

                    <dt class="col-3 mb-2">
                        Denda
                    </dt>
                    <dd class="col-9 mb-2">
                        {{ $car->penalty ?? '-' }}
                    </dd>

                    <dt class="col-3 mb-2">
                        Supir
                    </dt>
                    <dd class="col-9 mb-2">
                        {{ $transaction->with_driver == 1 ? 'YA' : 'TIDAK' }}
                    </dd>

                    <dt class="col-3 mb-2">
                        Ket.
                    </dt>
                    <dd class="col-9 mb-2">
                        {!! $transaction->description !!}
                    </dd>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="ps-lg-3 text-break">
                    <small class="fw-bolder" style="color: #f35525;">{{ $car->category->name }}</small>
                    <h1 class="title text-dark fw-bolder">
                        {{ $car->name }}
                    </h1>

                    <div class="mb-3 mt-1">
                        <span class="h4 fw-bolder">
                            {{ 'Rp.' . Number::format($transaction->price_car, locale: 'id') }}
                        </span>
                        <small style="color: #f35525;">(Harga saat mobil dirental)</small>
                    </div>

                    <div class="row">
                        <dt class="col-5 mb-2">
                            Transmisi
                        </dt>
                        <dd class="col-7 mb-2">
                            {{ $car->transmission }}
                        </dd>

                        <dt class="col-5 mb-2">
                            Kursi
                        </dt>
                        <dd class="col-7 mb-2">
                            {{ $car->capacity }}
                        </dd>

                        <dt class="col-5 mb-2">
                            Bagasi
                        </dt>
                        <dd class="col-7 mb-2">
                            {{ $car->space }} Koper
                        </dd>

                        <hr class="my-2">

                        <dt class="col-5 mb-2">
                            Harga Mobil
                        </dt>
                        <dd class="col-7 mb-2">
                            {{ 'Rp.' . Number::format($transaction->price_car, locale: 'id') }}
                            X
                            {{ $transaction->duration }} Hari
                        </dd>

                        <dt class="col-5 mb-2"></dt>
                        <dd class="col-7 mb-2">
                            {{ 'Rp.' . Number::format($transaction->price_car * $transaction->duration, locale: 'id') }}
                        </dd>

                        <dt class="col-5 mb-2">
                            Harga Supir
                        </dt>
                        <dd class="col-7 mb-2">
                            {{ 'Rp.' . Number::format($transaction->price_driver, locale: 'id') }}
                        </dd>

                        <dt class="col-5 mb-2 fw-bolder fs-6" style="color: #f35525;">
                            Total
                        </dt>
                        <dd class="col-7 mb-2 fw-bolder fs-6" style="color: #f35525;">
                            {{ 'Rp.' . Number::format($transaction->total, locale: 'id') }}
                        </dd>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
