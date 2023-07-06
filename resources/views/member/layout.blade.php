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

        html {
            scroll-behavior: smooth;
        }
    </style>
    @yield('css')
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
                <a class="nav-link custom-nav-item" href="{{ route('home') }}">Beranda <span
                        class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link custom-nav-item" href="{{ route('home')  }}#paket">Paket</a>
            </li>
        </ul>
        <div class="d-flex align-items-center">
            @auth()
                <img src="{{ asset('/assets/user.png') }}" height="20" alt="icon user" class="mr-2">
                <div class="dropdown">
                    <a href="#" class="btn-logout" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Logout
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                        <a class="dropdown-item" href="{{ route('logout') }}">Logout</a>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-login">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>
@yield('content')
<section id="footer" class="footer d-flex justify-content-between align-items-center p-5">
    <div class="text-center">
        <img src="{{ asset('/assets/logo.png') }}" height="150" alt="logo footer">
        <p style="color: whitesmoke">Sistem Informasi My Laundry</p>
    </div>
    <div class="text-center">
        <p style="color: whitesmoke">Kunjungi Tempat Kami</p>
        <div style="height: 300px">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.970824267103!2d110.80458657039696!3d-7.578154658120073!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a16783dbd32eb%3A0xe852ba0aa1842158!2sUniversitas%20Duta%20Bangsa%20(Kampus%201%20Bhayangkara)!5e0!3m2!1sid!2sid!4v1688621925364!5m2!1sid!2sid" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</section>

<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
@yield('js')
</body>
</html>
