<div>

    <div class="card">
        <div class="card-body">
            <div class="ps-lg-3 text-break">
                <div class="mb-3 d-flex justify-content-center">
                    <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image"
                        href="{{ Storage::url($product->imageProducts->first()->image_path) }}">
                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="img-fluid"
                            src="{{ Storage::url($product->imageProducts->first()->image_path) }}" />
                    </a>
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
                                    {{ 'Rp. ' . Number::format($product->price, locale: 'id') }}
                                </span>
                            </div>

                            <div class="row">
                                <dt class="col-5 mb-2">
                                    Transmisi
                                </dt>
                                <dd class="col-7 mb-2">
                                    {{ $product->transmission }}
                                </dd>

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
