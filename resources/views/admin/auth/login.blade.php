<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Login</title>
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
            <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3">
                <div class="card mt-2">
                    <div class="card-body">
                        <!-- auth -->
                        <h3 class="mb-4">Login to Admin.</h3>
                        <!-- <p class="mb-2">Log in with your data that you entered during registration.</p> -->
                        @if (session('msg'))
                        <div class="alert alert-light-{{ session('msgType') }} color-danger alert-dismissible fade show"
                            role="alert">
                            {{ session("msg") }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <form method="POST" action="{{route('admin.login.action')}}">
                            @csrf
                            <div class="mb-3">
                                <div class="form-group position-relative has-icon-left">
                                    <input name="email" type="text" class="form-control" placeholder="Email"
                                        value="{{ old('email') }}">
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                @error('email')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-group position-relative has-icon-left">
                                    <input name="password" type="password" class="form-control" placeholder="Password">
                                    <div class="form-control-icon">
                                        <i class="bi bi-shield-lock"></i>
                                    </div>
                                </div>
                                @error('password')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>


                            <div class="form-check d-flex align-items-end">
                                <input name="remember" class="form-check-input me-2" type="checkbox"
                                    id="flexCheckDefault">
                                <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                    Keep me logged in
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block shadow-lg mt-3">Log in</button>
                        </form>
                        <div class="text-center mt-4">
                            <p><a class="font-bold" href="#">Forgot password?</a></p>
                        </div>

                        <!-- auth -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('mazer/assets/js/bootstrap.bundle.min.js') }}"></script>

</body>

</html>
