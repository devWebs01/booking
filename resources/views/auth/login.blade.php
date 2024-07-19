<x-auth-layout>
    <x-slot name="title">Login Account</x-slot>
    <section class="py-5">
        <div class="container">
            <div class="row align-items-lg-center mb-5">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h1 class="display-3 fw-bolder">Nikmati perjalanan yang mudah <span class="text-primary">dan
                            nyaman dengan mobil kami.</span></h1>
                    <p class="lead fw-bold mt-3 mb-4">Masuk ke akun Anda untuk memulai perjalanan Anda dengan mobil
                        impian.
                    </p>

                </div>
                <div class="col-md-5 col-md-6">
                    <div class="card">
                        <a href="/" class="text-nowrap logo-img text-center d-block pt-5 w-100">
                            <h3 class="fw-bolder">Aquina Rental Jambi</h3>
                        </a>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">
                                        Email
                                    </label>

                                    <div class="col-auto">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        Kata Sandi
                                    </label>

                                    <div class="col-auto">
                                        <div class="input-group">
                                            <input id="password" type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="current-password">
                                            <button type="button" class="btn btn-light border" id="togglePassword">
                                                <i class="bi bi-eye" id="toggleIcon"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">
                                    Masuk
                                </button>
                            </form>
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-4 mb-0 fw-bold">Baru disini?</p>
                                <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Buat sebuah akun</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-auth-layout>
