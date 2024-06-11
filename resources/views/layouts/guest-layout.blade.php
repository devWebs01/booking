<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Jadoo | Travel Agency Landing Page UI</title>

    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/front-end/assets/img/favicons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('/front-end/assets/img/favicons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('/front-end/assets/img/favicons/favicon-16x16.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/front-end/assets/img/favicons/favicon.ico') }}">
    <link rel="manifest" href="{{ asset('/front-end/assets/img/favicons/manifest.json') }}">
    <meta name="msapplication-TileImage" content="{{ asset('/front-end/assets/img/favicons/mstile-150x150.png') }}">
    <meta name="theme-color" content="#ffffff">

    <link href="{{ asset('/front-end/assets/css/theme.min.css') }}" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/21fb7efcbe.js" crossorigin="anonymous"></script>
    @livewireStyles
    @stack('styles')
    @vite([])

    <style>
        .nav-bottom {
            background: rgba(255, 255, 255, 0.25);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
            backdrop-filter: blur(4px);
            -webkit-backdrop-filter: blur(4px);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
    </style>
</head>

<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand navbar-light fixed-top py-5 d-none d-lg-block"
            data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('/front-end/assets/img/logo.svg') }}" height="34" alt="logo" /></a><button
                    class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon">
                    </span></button>
                <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">

                    @livewire('layouts.guest-nav')

                </div>
            </div>
        </nav>

        <nav
            class="navbar navbar-light text-dark navbar-expand fixed-bottom d-lg-none d-xl-none rounded nav-bottom m-4">
            <ul class="navbar-nav nav-justified w-100">
                <li class="nav-item">
                    <a href="#" class="nav-link">
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
                    <a href="#" class="nav-link">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-search" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.414 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                            <path fill-rule="evenodd"
                                d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus-square"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M14 1H2a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z" />
                            <path fill-rule="evenodd"
                                d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-heart" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M8 2.748l-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                        </svg>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-person"
                            fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0zM8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6 5c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" />
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>


        <section class="container">
            {{ $slot }}
        </section>

        <section class="pb-0 pb-lg-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-7 col-12 mb-4 mb-md-6 mb-lg-0 order-0"> <img class="mb-4"
                            src="{{ asset('/front-end/assets/img/logo2.svg') }}" width=" 150" alt="jadoo" />
                        <p class="fs--1 text-secondary mb-0 fw-medium">Book your trip in minute, get full Control for
                            much
                            longer.</p>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-1 order-md-2">
                        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4">Company</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">About</a>
                            </li>
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Careers</a>
                            </li>
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Mobile</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-2 order-md-3">
                        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4">Contact</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Help/FAQ</a>
                            </li>
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Press</a>
                            </li>
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Affiliate</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 mb-4 mb-lg-0 order-lg-3 order-md-4">
                        <h4 class="footer-heading-color fw-bold font-sans-serif mb-3 mb-lg-4">More</h4>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Airlinefees</a></li>
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Airline</a>
                            </li>
                            <li class="mb-2"><a class="link-900 fs-1 fw-medium text-decoration-none"
                                    href="#!">Low
                                    fare
                                    tips</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-5 col-12 mb-4 mb-md-6 mb-lg-0 order-lg-4 order-md-1">
                        <div class="icon-group mb-4">
                            <a class="text-decoration-none icon-item shadow-social" id="facebook" href="#!">
                                <i class="fab fa-facebook-f"> </i>
                            </a>
                            <a class="text-decoration-none icon-item shadow-social" id="instagram" href="#!">
                                <i class="fab fa-instagram"> </i>
                            </a>
                            <a class="text-decoration-none icon-item shadow-social" id="twitter" href="#!">
                                <i class="fab fa-twitter"> </i>
                            </a>

                        </div>
                        <h4 class="fw-medium font-sans-serif text-secondary mb-3">Discover our app</h4>
                        <div class="d-flex align-items-center">
                            <a href="#!"> <img class="me-2"
                                    src="https://themewagon.github.io/jadoo/v1.0.0/assets/img/play-store.png"
                                    alt="play store" /></a>
                            <a href="#!"> <img src="{{ asset('/front-end/assets/img/apple-store.png') }}"
                                    alt="apple store" /></a>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="py-5 text-center">
            <p class="mb-0 text-secondary fs--1 fw-medium">All rights reserved@jadoo.co </p>
        </div>


        <script src="{{ asset('/front-end/vendors/@popperjs/popper.min.js') }}"></script>
        <script src="{{ asset('/front-end/vendors/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('/front-end/vendors/is/is.min.js') }}"></script>
        <script src="https://polyfill.io/v3/polyfill.min.js?features=window.scroll"></script>
        <script src="{{ asset('/front-end/vendors/fontawesome/all.min.js') }}"></script>
        <script src="{{ asset('/front-end/assets/js/theme.js') }}"></script>
        <link
            href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;family=Volkhov:wght@700&amp;display=swap"
            rel="stylesheet">
        @stack('scripts')
        @livewireScripts
</body>

</html>
