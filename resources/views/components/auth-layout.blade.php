<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Modernize Free</title>
        <link rel="shortcut icon" type="image/png" href="{{ asset('/back-end/assets/images/logos/favicon.png') }}" />
        <link rel="stylesheet" href="{{ asset('/back-end/assets/css/styles.min.css') }}" />

        <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">
        @vite([])
    </head>

    <body>
        <!--  Body Wrapper -->
        <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
            data-sidebar-position="fixed" data-header-position="fixed">
            <div
                class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
        <script src="{{ asset('/back-end/assets/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('/back-end/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const passwordField = document.getElementById('password');
                const togglePasswordButton = document.getElementById('togglePassword');
                const toggleIcon = document.getElementById('toggleIcon');

                togglePasswordButton.addEventListener('click', function() {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);

                    // Toggle icon class
                    if (type === 'text') {
                        toggleIcon.classList.remove('bi-eye');
                        toggleIcon.classList.add('bi-eye-slash');
                    } else {
                        toggleIcon.classList.remove('bi-eye-slash');
                        toggleIcon.classList.add('bi-eye');
                    }
                });
            });
        </script>
    </body>

</html>
