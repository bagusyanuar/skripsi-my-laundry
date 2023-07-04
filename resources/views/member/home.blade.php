<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Informasi Laundry</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/member.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark-primary">
    <a class="navbar-brand" href="#">My Laundry</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link custom-nav-item" href="#">Beranda <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-nav-item" href="#">Paket</a>
            </li>
        </ul>
        <div>
            <a href="{{ route('login') }}" class="btn-login">
                Login
            </a>
        </div>
    </div>
</nav>
<div class="hero-dark d-flex align-items-center">
    <div class="w-50 p-5 left-hero pr-5">
        <p style="font-size: 46px;">My Laundry</p>
        <p style="font-size: 20px; color: #a0aec0" class="mb-4">Selamat datang di sistem informasi penyedia jasa pemesanan laundry my
            laundry.</p>
        <a href="#" class="btn-register">Register</a>
    </div>
    <div class="w-50 p-3 right-hero">
        <div class="w-100 text-center">
            <img src="{{ asset('/assets/hero.png') }}" height="400" alt="hero image">
        </div>
    </div>
</div>
<div class="text-center p-3">
    <p style="font-size: 20px; color: #777777; font-weight: bold; letter-spacing: 2px;">Paket Kami</p>
</div>
<section id="paket" class="pb-5 pl-3 pr-3">
    <div class="row justify-content-center w-100">
        @forelse($pakets as $paket)
            <div class="col-3">
                <div class="card-paket shadow-lg d-flex flex-column align-items-center justify-content-between">
                    <p style="font-size: 16px; color: #777777; font-weight: bold;">{{ $paket->nama }}</p>
                    <div class=""></div>
                    <a href="#" class="card-paket-button">Pesan Sekarang</a>
                </div>
            </div>
        @empty

        @endforelse

    </div>
</section>

<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>
