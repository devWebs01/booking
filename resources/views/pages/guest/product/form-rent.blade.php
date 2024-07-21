<form wire:submit.prevent='rentproduct' method="post">
    <div class="row mb-4">
        <label for="rent_date" class="col-sm-2 col-form-label">Tanggal Rental</label>
        <div class="col-sm-10">
            <input type="date" class="form-control @error('rent_date') is-invalid @enderror" wire:model="rent_date"
                value="{{ today() }}" id="rent_date" aria-describedby="helpId" placeholder="rent_date" />
            @error('rent_date')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="row mb-4">
        <label for="duration" class="col-sm-2 col-form-label">Durasi</label>
        <div class="col-sm-10">

            <div class="input-group input-group-sm justify-content-center">
                <input type="number" class="form-control form-control-lg @error('duration') is-invalid @enderror"
                    wire:model="duration" id="duration" aria-describedby="helpId" placeholder="duration" min="1"
                    max="30" disabled />
                <button type="button" class="btn btn-body btn-sm border rounded-start-pill"
                    wire:loading.attr='disabled' wire:click="decrement">
                    <i class="fa-solid fa-minus"></i>
                </button>
                <button type="button" class="btn btn-body btn-sm border rounded-end-circle"
                    wire:loading.attr='disabled' wire:click="increment">
                    <i class="fa-solid fa-plus"></i>
                </button>

            </div>
            @error('duration')
                <small id="helpId" class="form-text text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>

    <div class="form-check mb-3">
        <input wire:model.live='with_driver' class="form-check-input" type="checkbox" value="" id="with_driver"
            {{ $with_driver == 0 ? '' : 'checked' }}>
        <label class="form-check-label" for="with_driver">
            <strong>
                Gunakan layanan pengemudi profesional
            </strong>
            <p>
                Jasa pengemudi profesional ini akan memastikan kamu tiba di tujuan dengan aman
                dan
                nyaman.
            </p>
            <p class="fw-bold text-primary">
                Rp. 200.000
            </p>
        </label>
    </div>

    <hr>

    <div class="row">
        <div class="row">
            <dt class="col-5 mb-2">
                Harga Mobil x Durasi
            </dt>
            <dd class="col-7 mb-2 text-end">
                {{ 'Rp.' . Number::format($product->price * $duration, locale: 'id') }}
                <input type="hidden" wire:model='price_product' value="{{ $product->price }}">
            </dd>
            <dt class="col-5 mb-2">
                Layanan Pengemudi
            </dt>
            <dd class="col-7 mb-2 text-end">
                {{ 'Rp.' . Number::format($with_driver == 1 ? 200000 : 0, locale: 'id') }}

            </dd>
            <dt class="col-5 mb-2">
                Total
            </dt>
            <dd class="col-7 mb-2 text-end">
                {{ 'Rp.' . Number::format($this->calculateSubTotal(), locale: 'id') }}
                <input type="hidden" wire:model='total' value="{{ $this->calculateSubTotal() }}">

            </dd>

            <hr>
        </div>
        <div class="d-grid mb-3">
            @if (!auth()->user()->identify && !auth()->user()->phone_number)
                <a class="btn btn-primary" href="{{ route('user.account', ['user' => auth()->user()->id]) }}"
                    role="button">Lengkapi Data</a>
            @else
                <button type="submit" class="btn btn-primary" role="button">Submit</button>
            @endif
        </div>
</form>
