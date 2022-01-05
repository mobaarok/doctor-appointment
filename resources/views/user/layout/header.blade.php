<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @yield('css')
    <title>Hello, world!</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-s mb-3" >
        <a class="navbar-brand" href="{{route('user.home')}}">Rehana</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="">About </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('hospital.reg.info') }}">Hospital Zone</a>
                </li>
            </ul>
            <form method="GET" action="{{ route('user.filter') }}" class="">
                <div class="input-group input-group-lg mb-3">
                    <input name="search_name" type="text" class="form-control"
                        placeholder="Search for doctor & hospital..." aria-label="Recipient's username"
                        aria-describedby="button-addon2">
                    <input type="hidden" name="location" value="Bangladesh" hidden>
                    <div class="input-group-append">
                        <button class="btn btn-search" type="submit" id="button-addon2">Search</button>
                    </div>
                </div>
            </form>`
            <!-- <a class="btn btn-info mx-2" href="">Login/Register</a>
                <a class="btn btn-warning mx-2" href="">Hospital</a> -->
            @if (Route::has('login'))
            <div class="top-right links">
                @auth
                <a href="{{ url('/home') }}">Home</a>
                @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                <a href="{{ route('register') }}">Register</a>
                @endif
                @endauth
            </div>
            @endif
        </div>
    </nav>
