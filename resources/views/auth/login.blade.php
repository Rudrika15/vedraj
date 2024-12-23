<!doctype html>
<html lang="en">

<head>
    <title>Vedraj</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />

    <style>
        .btn-primary {
            background-color: #643f36 !important;
            border-color: #643f36 !important;
            text-align: center !important;
        }
    </style>
</head>

<body style="background-color: #fffbd5;">
    <section class="h-100 gradient-form">
        <div class="container py-4 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-6">
                    <div class="card mt-4 rounded-3 text-black"
                        style="background-image: url('images/background.png'); background-repeat: no-repeat;  background-position: center; background-position: center 10ch;">
                        <div class="row g-0">
                            <div class="col">
                                <div class="card-body p-md-4 mx-md-4">

                                    <div class="text-center">
                                        <img src="{{ asset('images/vedraj_logo.png') }}" style="width: 185px;"
                                            alt="logo" class="rounded">
                                        <h3 class="mt-1 mb-5 pb-1">LOGIN</h3>
                                    </div>

                                    <form action="{{ route('authenticate') }}" method="POST">
                                        @csrf
                                        {{-- <p>Please login to your account</p> --}}

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example11">Email</label>
                                            <input type="email" name="email" id="form2Example11"
                                                class="form-control" placeholder=" email address" />
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div data-mdb-input-init class="form-outline mb-4">
                                            <label class="form-label" for="form2Example22">Password</label>
                                            <input type="password" name="password" id="form2Example22"
                                                class="form-control" />
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                type="submit">Log
                                                in</button> <br>
                                            <a class="text-muted" href="#!">Forgot password?</a>
                                        </div>

                                        {{-- <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-outline-danger">Create new</button>
                                        </div> --}}

                                    </form>

                                </div>
                            </div>
                            {{-- <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">

                                    <img src="{{ asset('images/vedraj_logo.png') }}" width="150" alt="">
                                </div>


                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
