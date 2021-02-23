<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title >Digital Fuel Station - DFS</title>
    <link rel="shortcut icon" href="{{asset('DigitalFuelStation/icon.png')}}" type="image/x-icon">


    <!-- Custom fonts for this template-->
    <link href="{{asset('DigitalFuelStation/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('DigitalFuelStation/css/sb-admin-2.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="{{asset('DigitalFuelStation/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="design.html">
                    <img src="{{asset('DigitalFuelStation/logo.png')}}" alt="" width="80%">
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="{{route('home')}}">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <li class="nav-item active">
                <a class="nav-link collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-burn"></i>
                    <span>Combustíveis</span></a>

                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Combustíveis</h6>
                        <a class="collapse-item" href="{{route('combustivel.index')}}">Index</a>
                        <a class="collapse-item" href="{{route('combustivel.create')}}">Novo Combustível</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider my-0">
             <li class="nav-item active">
                <a class="nav-link collapsed" href="index.html" data-toggle="collapse" data-target="#collapseTwo1" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-gas-pump"></i>
                    <span>Bombas</span></a>

                <div id="collapseTwo1" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Bombas</h6>
                        <a class="collapse-item" href="{{route('bomba.index')}}">Index</a>
                        <a class="collapse-item" href="{{route('bomba.create')}}">Nova Bomba</a>
                    </div>
                </div>
            </li>
            <hr class="sidebar-divider my-0">
            @if(Auth::check())
             <li class="nav-item active">
                <form action="{{route('logout')}}" id="logout" method="POST">
                  @csrf
                  <a class="nav-link" onclick="document.getElementById('logout').submit();"><i class="fas fa-sign-out-alt"></i>
                    <span>Sair</span></a>
                </form>
            </li>
            @endif

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            @if(Auth::check())
                             <li class="nav-item active">
                                <form action="{{route('logout')}}" id="logout" method="POST">
                                  @csrf
                                  <a class="nav-link" role="button"
                                aria-haspopup="true" aria-expanded="false" onclick="document.getElementById('logout').submit();"><span class="mr-2 d-none d-lg-inline text-gray-600 small">Sair</span>
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i></a>
                                </form>
                            </li>
                            @endif
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->  

            @yield('content')   


        </div>


            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('DigitalFuelStation/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('DigitalFuelStation/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('DigitalFuelStation/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('DigitalFuelStation/js/sb-admin-2.min.js')}}"></script>



    <!-- Page level plugins -->
    <script src="{{asset('DigitalFuelStation/vendor/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('DigitalFuelStation/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('DigitalFuelStation/js/demo/datatables-demo.js')}}"></script>


</body>

</html>