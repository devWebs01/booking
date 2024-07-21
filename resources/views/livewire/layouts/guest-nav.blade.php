<div>
    <nav class="navbar navbar-expand navbar-light fixed-top py-5 d-none d-lg-block"
        data-navbar-on-scroll="data-navbar-on-scroll">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('/front-end/assets/img/logo.svg') }}" height="34" alt="logo" /></a><button
                class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span
                    class="navbar-toggler-icon">
                </span></button>
            <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base align-items-lg-center align-items-start">
                    <li class="nav-item px-3 px-xl-4">
                        <a class="nav-link fw-medium" aria-current="page" href="/">Beranda</a>
                    </li>
                    <li class="nav-item px-3 px-xl-4">
                        <a class="nav-link fw-medium" aria-current="page" href="{{ route('geolocation') }}">Rental
                            Mobil</a>
                    </li>
                    @auth
                        @if (auth()->user()->role === 'admin')
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route('home') }}">Beranda</a>
                            </li>
                        @else
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route('transaction.guest') }}">
                                    Transaksi Mobil
                                </a>
                            </li>
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium" aria-current="page"
                                    href="{{ route('user.account', ['user' => auth()->user()->id]) }}">
                                    Akun Profil
                                </a>
                            </li>
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                    Logout
                                </a>
                            </li>
                        @endif
                    @else
                        <li class="nav-item px-3 px-xl-4">
                            <a class="nav-link fw-medium" aria-current="page" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item px-3 px-xl-4">
                            <a class="nav-link fw-medium" aria-current="page" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>

            </div>
        </div>
    </nav>

    <nav class="navbar navbar-light text-dark navbar-expand fixed-bottom d-lg-none d-xl-none rounded nav-bottom m-4">
        <ul class="navbar-nav nav-justified w-100">
            <li class="nav-item">
                <a href="/" class="nav-link">
                    <i class="bi bi-house-door fs-3"></i>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('geolocation') }}" class="nav-link">
                    <i class="bi bi-map-fill fs-3"></i>
                </a>
            </li>
            @auth
                @if (auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <i class="bi bi-person-workspace fs-3"></i>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('transaction.guest') }}" class="nav-link">
                            <i class="bi bi-car-front-fill fs-3"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                            class="nav-link">
                            <i class="bi bi-box-arrow-right fs-3"></i>
                        </a>
                    </li>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <i class="bi bi-person-bounding-box fs-3"></i>
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

</div>
