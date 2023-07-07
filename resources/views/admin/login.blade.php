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
    <link href="{{ asset('/css/sweetalert2.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/sweetalert2.min.js')}}"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .card-login {
            background-color: white;
            border-radius: 10px;
            width: 25%;
        }
    </style>
</head>
<body>
@if (\Illuminate\Support\Facades\Session::has('failed'))
    <script>
        Swal.fire("Gagal", '{{\Illuminate\Support\Facades\Session::get('failed')}}', "error")
    </script>
@endif
<div style="height: 100vh; width: 100%; background-color: #03045E"
     class="d-flex justify-content-center align-items-center">
    <div class="shadow-lg p-3 card-login">
        <p class="text-center font-weight-bold">Form Login Admin</p>
        <form method="post">
            @csrf
            <div class="w-100 mb-1">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" placeholder="Username"
                       name="username">
            </div>
            <div class="w-100 mb-1">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" placeholder="Password"
                       name="password">
            </div>
            <hr>
            <div class="d-flex align-items-center justify-content-end">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('/jQuery/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="{{ asset('/bootstrap/js/bootstrap.js') }}"></script>
</body>
</html>
