<!DOCTYPE html>
<html lang="en">

<head>
    <title>Vedraj</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    {{-- sweet alert css cdn --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- font awesome cdn --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="bg-light">

    {{-- header --}}
    <nav class="navbar navbar-expand-md bg-primary mb-5" style="height: 65px;">
        <div class="container">
            <a class="navbar-brand  mt-4 pt-5" href="#">
                <img src="{{ asset('images/vedraj_logo.png') }}" class="img-fluid shadow" alt="" width="150">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fw-bold" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link @if (Route::currentRouteName() == 'dashboard') active @endif"
                            href="{{ route('dashboard') }}">
                            <i class="fa fa-home"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if (Str::is('branch*', Route::currentRouteName())) active @endif"
                            href="{{ route('branch.index') }}">
                            <i class="fa fa-building"></i>
                            <span>Branches</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if (Str::is('staff*', Route::currentRouteName())) active @endif"
                            href="{{ route('staff.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Staff</span>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link @if (Str::is('disease*', Route::currentRouteName())) active @endif"
                            href="{{ route('disease.index') }}">
                            <i class="fa fa-medkit"></i>
                            <span>Disease</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Str::is('product*', Route::currentRouteName())) active @endif"
                            href="{{ route('product.index') }}">
                            <i class="fa fa-shop"></i>
                            <span>Product</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Str::is('article*', Route::currentRouteName())) active @endif"
                            href="{{ route('article.index') }}">
                            <i class="fa fa-newspaper"></i>
                            <span>Article </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if (Str::is('video*', Route::currentRouteName())) active @endif"
                            href="{{ route('video.index') }}">
                            <i class="fa fa-video"></i>
                            <span>Video</span>
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li> --}}
                </ul>
            </div>
        </div>
    </nav>

    <div class="container  p-5">
        <div class="card shadow">
            <div class="card-body">
                @yield('content')
            </div>
        </div>
    </div>

    <footer>
        <div class="container-fluid ">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Vedraj 2024</p>
                </div>
            </div>
        </div>
    </footer>
    {{-- jquery latest cdn --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    {{-- sweetalert cdn --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @if (session('success'))
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "opacity": 1
                }
                $('.toast').css('opacity', '1');
                toastr.success("{{ session('success') }}");
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            $(document).ready(function() {
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut",
                    "opacity": 1
                }
                toastr.error("{{ session('error') }}");
            });
        </script>
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for clicks on delete buttons
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default action of the link

                    const deleteUrl = this.getAttribute('data-url'); // Get the URL

                    // SweetAlert v2 confirmation dialog
                    Swal.fire({
                        title: "Are you sure?",
                        text: "You will not be able to recover this record!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Redirect to the delete URL if confirmed
                            window.location.href = deleteUrl;
                        }
                    });
                });
            });
        });
    </script>

</body>

</html>
