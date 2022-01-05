<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital - Information</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('mazer/assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('mazer/assets/vendors/bootstrap-icons/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{asset('mazer/assets/css/app.css')}}">
    <link rel="shortcut icon" href="{{asset('mazer/assets/images/favicon.svg')}}" type="image/x-icon">
</head>

<body>
    <nav class="navbar navbar-light ">
        <div class="container d-block">
            <a class="navbar-brand ms-4" href="index.html">
                <img src="{{asset('mazer/assets/images/logo/rehana.png')}}">
            </a>
        </div>
    </nav>


    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3">
                <div class="card mt-2">
                    <div class="card-body">
                        <h3 class="mb-4">Hospital User Information</h3>
                        <p> <span>হাসপাতাল ইউজার হিসাবে লগইন করতে ভিজিট করুনঃ</span>
                            <a href="{{ route('hospital.login') }}">Login</a>
                        </p>
                    <p>
                  <span>আপনি যদি হাসপাতাল ইউজার না হয়ে থাকেন তবে রেজিঃ করতে ভিজিট করুনঃ</span>
                        <a href="{{ route('hospital.register') }}">Register</a>
                    </p>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('mazer/assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
