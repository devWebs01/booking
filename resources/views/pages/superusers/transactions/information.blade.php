<div>

    <div class="card">
        <div class="card-body">
            <div class="ps-lg-3 text-break">
                <div class="mb-3 d-flex justify-content-center">
                    @if ($product->imageProducts->isNotEmpty())
                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->imageProducts as $no => $item)
                                <div class="carousel-item {{ ++$no == 1 ? 'active' : '' }}">
                                    <img style="width: 100%; height: auto; margin: auto;"
                                        src="{{ Storage::url($item->image_path) }}" />
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button"
                            data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button"
                            data-bs-target="#carouselExampleControls" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <img src="https://png.pngtree.com/png-vector/20190820/ourmid/pngtree-no-image-vector-illustration-isolated-png-image_1694547.jpg"
                        class="img-fluid" alt="image" />
                @endif
                </div>

                <div class="row gx-5">
                    <div class="col-lg-6">
                        <div class="ps-lg-3 text-break">
                            <small class="fw-bold" style="color: #f35525;">{{ $product->category->name }}</small>
                            <h1 class="title text-dark fw-bold">
                                {{ $product->name }}
                            </h1>

                            <div class="my-3">
                                <span class="h5 fw-bold">
                                    {{ $transaction->formatRupiah($transaction->price_product * $transaction->duration) }}
                                    <small style="color: #f35525;">(Harga Saat Mobil Dirental)</small>
                                </span>
                            </div>

                            <div class="row">
                                <dt class="col-5 mb-2">
                                    Kursi
                                </dt>
                                <dd class="col-7 mb-2">
                                    {{ $product->capacity }}
                                </dd>

                                <dt class="col-5 mb-2">
                                    Bagasi
                                </dt>
                                <dd class="col-7 mb-2">
                                    {{ $product->space }} Koper
                                </dd>

                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="mb-3" style="overflow-wrap: anywhere;">
                            {!! $product->description !!}
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
