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
                        @if (auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route('home') }}">Home</a>
                            </li>
                        @else
                            <li class="nav-item px-3 px-xl-4">
                                <a class="nav-link fw-medium" aria-current="page" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">Logout</a>
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
                    <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd"
                            d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('geolocation') }}" class="nav-link">
                    <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor"
                        class="bi bi-map" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M16 .5a.5.5 0 0 0-.598-.49L10.5.99 5.598.01a.5.5 0 0 0-.196 0l-5 1A.5.5 0 0 0 0 1.5v14a.5.5 0 0 0 .598.49l4.902-.98 4.902.98a.5.5 0 0 0 .196 0l5-1A.5.5 0 0 0 16 14.5zM5 14.09V1.11l.5-.1.5.1v12.98l-.402-.08a.5.5 0 0 0-.196 0zm5 .8V1.91l.402.08a.5.5 0 0 0 .196 0L11 1.91v12.98l-.5.1z" />
                    </svg>
                </a>
            </li>
            @auth
                @if (auth()->user()->role === 'admin' || auth()->user()->role === 'owner')
                    <li class="nav-item">
                        <a href="{{ route('home') }}" class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor"
                                class="bi bi-person-badge" viewBox="0 0 16 16">
                                <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path
                                    d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z" />
                            </svg>
                        </a>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();"
                            class="nav-link">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1.5em" height="1.5em" fill="currentColor"
                                class="bi bi-person-x" viewBox="0 0 16 16">
                                <path
                                    d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m.256 7a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z" />
                                <path
                                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708" />
                            </svg>
                        </a>
                    </li>
                @endif
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            @else
                <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                    </a>
                </li>
            @endauth
        </ul>
    </nav>

</div>
