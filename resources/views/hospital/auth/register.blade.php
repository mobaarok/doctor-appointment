<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehana - Register as a Hospital</title>
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
            <a class="navbar-brand ms-4" href="#">
                <img src="{{asset('mazer/assets/images/logo/rehana.png')}}">
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-6 offset-md-3">
                <div class="card mt-2">
                    <div class="card-body">

                        <h3 class="">Register a Hospital</h3>
                        <p class="mb-2">Input your data to register to as a Hospital.</p>
                        <form method="POST" action="{{ route('hospital.registerHospitalAction') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="hospitalName">Hospital Name</label>
                                        <input name="hospital_name" type="text" class="form-control" id="hospitalName"
                                            placeholder="eg.Example Hospital Ltd" value="{{old('hospital_name')}}">
                                        @error('hospital_name')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input name="email" type="email" class="form-control" id="email"
                                            placeholder="eg. example@email.com" value="{{old('email')}}">
                                        @error('email')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="mobile">Mobile</label>
                                        <input name="mobile_phone" type="text" class="form-control" id="mobile"
                                            placeholder="eg.016348895857" value="{{old('mobile_phone')}}">
                                        @error('mobile_phone')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input name="password" type="password" id="password" class="form-control"
                                            placeholder="*****">
                                        @error('password')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <p><small class="text-muted">Password must be at lest 6 digit.</small></p>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="confirmPassword">Confirm Password</label>
                                        <input name="password_confirmation" type="password" id="confirmPassword"
                                            class="form-control" placeholder="*****">
                                        @error('password_confirmation')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <p><small class="text-muted">Please enter password again.</small></p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-check">
                                        <div class="checkbox">
                                            <input name="agree" type="checkbox" class="form-check-input" id="agree"
                                                {{old('agree') ? 'checked' : '' }}>
                                            <label class="form-check-label text-gray-600" for="agree">I agree to the
                                                terms and conditions.</label>
                                        </div>
                                    </div>
                                    @error('agree')
                                    <div class="text-danger">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                    <p><small class="text-muted">Please check the box.</small></p>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-block shadow-lg">Register</button>
                        </form>
                        <div class="text-center mt-4">
                            <p class='text-gray-600'>Already have an account? <a href="{{route('hospital.login')}}"
                                    class="font-bold"> Log
                                    in</a>.</p>
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
