{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

<div class="card-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Name') }}</label>


            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
</div>

<div class="mb-3">
    <label for="email" class="form-label">{{ __('Email Address') }}</label>


    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email">

    @error('email')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div>

<div class="mb-3">
    <label for="password" class="form-label">{{ __('Password') }}</label>


    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="new-password">

    @error('password')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>
</div>

<div class="mb-3">
    <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>


    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
        autocomplete="new-password">
</div>
</div>

<div class="row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection --}}

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
                            <form method="POST" action="{{ route('register') }}">
                                @csrf

                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email Address') }}</label>
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>


                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="password-confirm"
                                        class="form-label">{{ __('Confirm Password') }}</label>


                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                                <button type="submit" class="btn btn-primary w-100 py-8 fs-4 rounded-2">Sign
                                    In</button>
                            </form>
                        </div>
                        <div class="d-flex align-items-center justify-content-center mb-3">
                            <p class="fs-4 mb-0 fw-bold">Udah punya akun?</p>
                            <a class="text-primary fw-bold ms-2" href="{{ route('login') }}">Login sekarang</a>
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
