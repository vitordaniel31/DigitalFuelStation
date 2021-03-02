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
       

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-dark  bg-dark topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                
                <div class="row">
                    <div class="col-3 col-md-3">
                        <img src="{{asset('DigitalFuelStation/logo.png')}}" class="img-fluid" alt="">
                    </div>
                </div>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                    
                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            @if(Auth::guard('bomba')->check())
                             <li class="nav-item active">
                                <form action="{{route('bomba.logout')}}" id="logout1" method="POST">
                                  @csrf
                                  <a class="nav-link" role="button"
                                aria-haspopup="true" aria-expanded="false" onclick="document.getElementById('logout1').submit();"><span class="mr-2 d-none d-lg-inline text-gray-600 small">Sair</span>
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i></a>
                                </form>
                            </li>
                            @endif
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->  

            <div class="container-fluid">
                            @foreach (['danger', 'success'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                  <div class="alert alert-{{ $msg }}" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                  </div>
                                @endif
                            @endforeach
                            @error('valor')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('quantidade')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            @error('id_combustivel')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror

                    <!-- Page Heading -->
                    <div class="d-sm-flex justify-content-center">
                        <h1 class="h3 mb-0 text-gray-800">Abasteça seu veículo - Bomba {{Auth::guard('bomba')->user()->codigo}}</h1>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Abastecimento</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('venda.store')}}">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-12 justify-content-center">
                                        <label class="bmd-label-floating">Combustível</label>
                                         <div class="form-group">
                                            <input type="hidden" id="combustivel" name="id_combustivel" value="0">
                                            <div class="row">
                                            @foreach ($combustiveis as $combustivel)
                                                <div class="col-xl-4 col-md-6 mb-4">
                                                  
                                                        <div id="card{{$combustivel->id}}" onclick="select({{$combustivel->id}}, {{$combustivel->preco}}, {{$combustivel->qtd_restante}});" class="card border-left-danger shadow h-100 py-2">
                                                            <div class="card-body">
                                                                <div class="row no-gutters align-items-center">
                                                                    <div class="col mr-2">
                                                                        <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{$combustivel->combustivel}}
                                                                        </div>
                                                                        <div class="row no-gutters align-items-center">
                                                                            <div class="col-auto">
                                                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{($combustivel->qtd_restante/$combustivel->capacidade)*100}}%</div>
                                                                            </div>
                                                                            <div class="col">
                                                                                <div class="progress progress-sm mr-2">
                                                                                    <div class="progress-bar bg-danger" role="progressbar"
                                                                                        style="width: {{($combustivel->qtd_restante/$combustivel->capacidade)*100}}%" aria-valuenow="{{($combustivel->qtd_restante/$combustivel->capacidade)*100}}" aria-valuemin="0"
                                                                                        aria-valuemax="100"></div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <small>{{intval($combustivel->qtd_restante)}}/{{intval($combustivel->capacidade)}} litros</small>
                                                                    </div>
                                                                    <div class="col-auto">
                                                                        <i class="fas fa-gas-pump fa-2x text-gray-300"></i>
                                                                    </div>
                                                                     <h3>{{$combustivel->combustivel}} - R$ {{$combustivel->preco}}</h3>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                               
                                            @endforeach
                                            </div>
                                            @error('combustivel')
                                                <div class="alert alert-primary" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Valor (R$)</label>
                                            <input onkeyup="atualizaValor()" type="text" id="valor" name="valor" class="form-control">
                                            @error('valor')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Quantidade (Litros)</label>
                                            <input onkeyup="atualizaQtd()" type="text" id="quantidade" value="1" name="quantidade" class="form-control">
                                            @error('quantidade')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>  
                                </div>
                                <div class="row justify-content-center">
                                    <div class="form-group">
                                      <input type="submit" value="Comprar" class="btn btn-secondary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>


        </div>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Digital Fuel Station 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

    <script src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
    <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
   

    <script type="text/javascript">
        document.getElementById('card'+{{$combustivel->id}}).classList.add('bg-dark');
        document.getElementById('valor').value = {{$combustivel->preco}}.toFixed(2);
        document.getElementById('combustivel').value = {{$combustivel->id}};
        var precocombustivel = {{$combustivel->preco}};
        $('#quantidade').inputmask({max: {{$combustivel->qtd_restante}}});
        $('#valor').inputmask({max: ({{$combustivel->qtd_restante}}/precocombustivel).toFixed(2)});
        $('#quantidade').inputmask('decimal', {
            mask: "9{1,6}.9{0,2}",
            min: 0.01
        });
        $('#valor').inputmask({
            mask: "9{1,6}.9{0,2}",
            min: 0.01,
        });

        function select(id, preco, restante){
            if (document.getElementById('combustivel').value != id){
                if (document.getElementById('combustivel').value!=0) {
                    document.getElementById('card'+document.getElementById('combustivel').value).classList.remove('bg-dark');
                    document.getElementById('combustivel').value = 0;

                }
                document.getElementById('quantidade').max
                document.getElementById('combustivel').value = id;
                document.getElementById('card'+id).classList.add('bg-dark');
                var valor = preco*document.getElementById('quantidade').value;
                document.getElementById('valor').value = valor.toFixed(2); 
                precocombustivel = preco;
                $('#quantidade').inputmask('decimal', {max: restante});
                $('#valor').inputmask('decimal', {max: (restante/preco).toFixed(2)});
            } 
        }

        function atualizaQtd(){
            var qtd = document.getElementById('quantidade').value;
            var valor = qtd*precocombustivel;
            document.getElementById('valor').value = valor.toFixed(2);
        }

        function atualizaValor(){
            var valor = document.getElementById('valor').value;
            var quantidade = valor/precocombustivel;
            document.getElementById('quantidade').value = quantidade.toFixed(2); 
        }
    </script>

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