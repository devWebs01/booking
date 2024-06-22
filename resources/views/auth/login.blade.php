<x-auth-layout>
    <section class="py-5">
        <div class="container">
            <div class="row align-items-lg-center mb-5">
                <div class="col-md-6 mb-5 mb-md-0">
                    <h1 class="display-3 fw-bolder">Design Faster and Smarter with <span
                            class="text-primary">Bootstrap</span></h1>
                    <p class="lead mt-3 mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam feugiat erat
                        quis pulvinar semper.</p>
                </div>
                <div class="col-md-5 col-md-6">
                    <div class="card">
                        <a href="/" class="text-nowrap logo-img text-center d-block pt-5 w-100">
                            <img src="/back-end/assets/images/logos/dark-logo.svg" width="180" alt="">
                        </a>
                        <div class="card-body">
                            <form method="POST" action="{{ route('login') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>

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
                                    <label for="password" class="form-label">{{ __('Password') }}</label>

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

                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Sign
                                    In</button>
                            </form>
                            <div class="d-flex align-items-center justify-content-center">
                                <p class="fs-4 mb-0 fw-bold">Baru disini?</p>
                                <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">Buat sebuah akun</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row d-lg-flex d-none text-center">
                <div class="col p-3"><img alt="Logo" src="https://freefrontend.dev/assets/logo1.svg"></div>
                <div class="col p-3"><img alt="Logo" src="https://freefrontend.dev/assets/logo2.svg"></div>
                <div class="col p-3"><img alt="Logo" src="https://freefrontend.dev/assets/logo3.svg"></div>
                <div class="col p-3"><img alt="Logo" src="https://freefrontend.dev/assets/logo4.svg"></div>
                <div class="col p-3"><img alt="Logo" src="https://freefrontend.dev/assets/logo5.svg"></div>
            </div>
        </div>
    </section>

</x-auth-layout>
