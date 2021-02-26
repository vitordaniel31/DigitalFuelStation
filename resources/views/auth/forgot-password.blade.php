<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Digital Fuel Station - DFS</title>
    <link rel="shortcut icon" href="{{asset('DigitalFuelStation/icon.png')}}" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="{{asset('DigitalFuelStation/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css')}}">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('DigitalFuelStation/css/sb-admin-2.css')}}" rel="stylesheet">

</head>

<body class="bg-gradient-dark">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6  d-lg-block bg-login-image">
                                <img src="{{asset('DigitalFuelStation/imglogin.png')}}" alt="" width="115%">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Digital Fuel Station - Redefinir Senha</h1>
                                    </div>
                                    <form class="user" id="email" method="POST" action="{{route('password.email')}}">
                                        @csrf
                                        @if(Session::has('status'))
                                          <div class="alert alert-success" role="alert">
                                            {{ Session::get('status') }}
                                          </div>
                                        @endif
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Insira seu email:" name="email">
                                            @error('email')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <a onclick="document.getElementById('email').submit();" class="btn btn-danger btn-user btn-block">
                                            Enviar
                                        </a>
                                    </form>
                        
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('DigitalFuelStation/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('DigitalFuelStation/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('DigitalFuelStation/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('DigitalFuelStation/js/sb-admin-2.min.js')}}"></script>

</body>

</html>
