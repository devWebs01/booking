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
</head>

<body>
    <main class="main" id="top">
        <nav class="navbar navbar-expand-lg navbar-light fixed-top py-5 d-block"
            data-navbar-on-scroll="data-navbar-on-scroll">
            <div class="container"><a class="navbar-brand" href="#">
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

        <section class="container" style="padding-top: 7rem;">
            {{ $slot }}
        </section>



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
