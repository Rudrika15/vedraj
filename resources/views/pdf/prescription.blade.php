<!doctype html>
<html lang="en">

<head>
    <title></title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    <header>
    </header>
    <main>

        <div class="container mt-5">
            <div class="card "
                style="background-image: url('{{ $base64Image }}'); background-repeat: no-repeat; background-position: center 10ch;">
                <div class="card-header">
                    <div class="">
                        <h1 class="text-center">Prescription</h1>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h3>Doctor Details</h3>
                            <hr>
                            <p>Doctor Name: {{ $prescription->user->name ?? '' }}</p>
                        </div>
                        <div class="col">
                            <h3>Patient Details</h3>
                            <hr>
                            <p>Name:
                                {{ $prescription->appointment->name ?? ($prescription->appointment->user->name ?? '') }}
                            </p>
                            <p>Date Of Birth:
                                {{ $prescription->appointment->dob ?? ($prescription->appointment->user->dob ?? '') }}
                            </p>
                            <p>Address:
                                {{ $prescription->appointment->address ?? ($prescription->appointment->user->address ?? '') }}
                            </p>
                            <p>Phone:
                                {{ $prescription->appointment->contact ?? ($prescription->appointment->user->mobile_no ?? '') }}
                            </p>
                            <p>Email:
                                {{ $prescription->appointment->email ?? ($prescription->appointment->user->email ?? '') }}
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <h3>Appointment Details</h3>
                            <hr>
                            <p>Date: {{ $prescription->appointment->date ?? '' }}
                            </p>
                            <p>slot: {{ $prescription->appointment->slot ?? '' }}</p>
                            <p>subject: {{ $prescription->appointment->subject }}</p>
                            <p>message: {{ $prescription->appointment->message }}</p>
                        </div>
                        {{-- <div class="col">
                            <h3>Medical Details</h3>
                            <hr>
                            @foreach ($prescription->medicines as $item)
                                <p>
                                    @if (Auth::user()->language == 'en')
                                        Product Name: {{ $item->products->product_name ?? '' }}
                                    @else
                                        Product Name: {{ $item->products->product_name_hindi ?? '' }}
                                    @endif
                                    <br>
                                    Product Details : {{ $item->products->description ?? '' }}
                                    <br>
                                    When to take: {{ $item->to_be_taken ?? '' }} Meal
                                    <br>
                                    Time: {{ $item->time ?? '' }}
                                    <br>
                                    Note: {{ $item->note ?? '' }}

                                </p>
                            @endforeach
                        </div> --}}
                        {{-- <div class="row"> --}}
                        <div class="col">
                            <h3>Food Plan</h3>
                            <hr>
                            <p>
                                @if (Auth::user()->language == 'en')
                                    {{ $prescription->disease->food_plan ?? ($prescription->appointment->disease->food_plan ?? '') }}
                                @else
                                    {{ $prescription->disease->food_plan_hindi ?? ($prescription->appointment->disease->food_plan_hindi ?? '') }}
                                @endif
                            </p>

                        </div>
                        {{-- </div> --}}
                    </div>

                </div>
            </div>
        </div>
        <div class="container mt-5">
            <div class="table table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Product Name</th>
                            {{-- <th scope="col">Product Details</th> --}}
                            <th scope="col">When to take</th>
                            <th scope="col">Time</th>
                            <th scope="col">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($prescription->medicines as $item)
                            <tr>
                                <td>{{ $item->products->product_name ?? '' }}</td>
                                {{-- <td>{{ $item->products->description ?? '' }}</td> --}}
                                <td>{{ $item->to_be_taken ?? '' }} Meal</td>
                                <td>{{ $item->time ?? '' }}</td>
                                <td>{{ $item->note ?? '' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
</body>

</html>
