<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <title>Hello, world!</title>
</head>

<body>


    <div class="container mt-5">
        <!-- main row  -->
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <!-- title Crad Start -->
                <div class="card mt-3">
                    <div class="card-body">
                        @if($hospital->is_activated == 0)
                            <h5 class="card-title mb-4 text-center">
                                Hello, Mrs/Ms
                                Welcome to Doc Appo
                            </h5>
                            <h3>Please Call 01200582382 to activated and work with us </h3>
                            <h2>your hospital: {{$hospital->hospital_name}}</h2>
                            @else
                            <h3>your account already active, please goto dashboard</h3>

                            @endif

                    </div>
                </div>
                <!-- title Card End -->
            </div>

        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
        integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
        crossorigin="anonymous"></script>
</body>

</html>
