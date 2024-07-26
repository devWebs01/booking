<!DOCTYPE html>
<html lang="en-US" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} | Rent Car Landing Page UI</title>
    <!-- PWA  -->
    <meta name="theme-color" content="#ffffff">

    <meta name="msapplication-TileImage" content="{{ asset('/front-end/assets/img/favicons/aquina-logo-150x150.jpg') }}">
    <link rel="apple-touch-icon" sizes="180x180"
        href="{{ asset('/front-end/assets/img/favicons/aquina-apple-icon.jpg') }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="{{ asset('/front-end/assets/img/favicons/aquina-logo-32x32.jpg') }}">
    <link rel="icon" type="image/png" sizes="16x16"
        href="{{ asset('/front-end/assets/img/favicons/aquina-logo-16x16.jpg') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('/front-end/assets/img/favicons/aquina-logo.ico') }}">

    <link rel="manifest" href="{{ asset('/manifest.json') }}">

    <link href="{{ asset('/front-end/assets/css/theme.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://kit.fontawesome.com/21fb7efcbe.js" crossorigin="anonymous"></script>

    @vite([])

    @livewireStyles

    @stack('css')

    <style>
        .form-control {
            border-radius: 10px;
        }

        .btn {
            border-radius: 10px;
        }
    </style>
</head>

<body>
    @include('layouts.loading')
    <main class="main" id="top">

        @livewire('layouts.guest-nav')

        <section class="container">
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

        <script src="{{ asset('/sw.js') }}"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl)
                })
            });

            if ("serviceWorker" in navigator) {
                // Register a service worker hosted at the root of the
                // site using the default scope.
                navigator.serviceWorker.register("/sw.js").then(
                    (registration) => {
                        console.log("Service worker registration succeeded:", registration);
                    },
                    (error) => {
                        console.error(`Service worker registration failed: ${error}`);
                    },
                );
            } else {
                console.error("Service workers are not supported.");
            }
        </script>

        @stack('scripts')

        @livewireScripts

        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <x-livewire-alert::scripts />
</body>

</html>
