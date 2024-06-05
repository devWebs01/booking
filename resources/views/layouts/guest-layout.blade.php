<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <title>{{ $title ?? '' }} - Laramap</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/front-end/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('/front-end/assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/assets/css/templatemo-scholar.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/assets/css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('/front-end/assets/css/animate.css') }}">
    <link rel="stylesheet"href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    @livewireStyles
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        * {
            font-family: "Poppins", sans-serif;
            font-weight: 600;
        }
    </style>

    @stack('styles')
    @vite([])
</head>

<body>

    <!-- ***** Preloader Start ***** -->
    {{-- <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div> --}}
    <!-- ***** Preloader End ***** -->

    <!-- ***** Header Area Start ***** -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @livewire('layouts.guest-nav')
                </div>
            </div>
        </div>
    </header>
    <!-- ***** Header Area End ***** -->

    <main>
        {{ $slot }}
    </main>

    <footer>
        <div class="container">
            <div class="col-lg-12">
                <p>Copyright © 2036 Scholar Organization. All rights reserved. &nbsp;&nbsp;&nbsp; Design: <a
                        href="https://templatemo.com" rel="nofollow" target="_blank">TemplateMo</a> Distribution: <a
                        href="https://themewagon.com" rel="nofollow" target="_blank">ThemeWagon</a></p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="{{ asset('/front-end/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('/front-end/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/front-end/assets/js/isotope.min.js') }}"></script>
    <script src="{{ asset('/front-end/assets/js/owl-carousel.js') }}"></script>
    <script src="{{ asset('/front-end/assets/js/counter.js') }}"></script>
    <script src="{{ asset('/front-end/assets/js/custom.js') }}"></script>

    @stack('scripts')
    @livewireScripts
</body>

</html>
