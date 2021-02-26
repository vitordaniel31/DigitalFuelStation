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

        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        <!-- jQuery.NumPad -->
    <script src="{{asset('DigitalFuelStation/jquery.numpad.js')}}"></script>
    <link rel="stylesheet" href="{{('DigitalFuelStation/jquery.numpad.css')}}">
    <script type="text/javascript">
            // Set NumPad defaults for jQuery mobile. 
            // These defaults will be applied to all NumPads within this document!
        $.fn.numpad.defaults.gridTpl = '<table class="table modal-content"></table>';
        $.fn.numpad.defaults.backgroundTpl = '<div class="modal-backdrop in"></div>';
        $.fn.numpad.defaults.displayTpl = '<input type="text" class="form-control" />';
        $.fn.numpad.defaults.buttonNumberTpl =  '<button type="button" class="btn btn-default"></button>';
        $.fn.numpad.defaults.buttonFunctionTpl = '<button type="button" class="btn" style="width: 100%;"></button>';
        $.fn.numpad.defaults.onKeypadCreate = function(){$(this).find('.done').addClass('btn-primary');};
            
            // Instantiate NumPad once the page is ready to be shown
        $(document).ready(function(){
            $('#numpadButton-btn').numpad({
                target: $('#quantidade')
            });
            $('#numpadButton-btn2').numpad({
                target: $('#preco')
            });
        });
    </script>
    <style type="text/css">
        .nmpd-grid {border: none; padding: 20px;}
        .nmpd-grid>tbody>tr>td {border: none;}
            
        /* Some custom styling for Bootstrap */
        .qtyInput {display: block;
             width: 100%;
             padding: 6px 12px;
             color: #555;
             background-color: white;
             border: 1px solid #ccc;
             border-radius: 4px;
             -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
             box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
             -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
             -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
             transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        }
    </style>

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
                                            @foreach ($combustiveis as $combustivel)
                                                <div class="col-xl-4 col-md-6 mb-4">
                                                    <div id="card{{$combustivel->id}}" class="card border-left-danger shadow h-100 py-2" onclick="select({{$combustivel->id}}, {{$combustivel->preco}});">
                                                        <div class="card-body">
                                                            {{$combustivel->combustivel}} - R$ {{$combustivel->preco}}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @error('combustivel')
                                                <div class="alert alert-primary" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Valor</label>
                                            <input type="text" id="valor" name="valor" class="form-control">
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
                                            <input type="text" id="quantidade" name="quantidade" class="form-control">
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
                                      <input type="submit" value="Adicionar" class="btn btn-secondary">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
            </div>


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

    <script type="text/javascript">
        document.getElementById('card'+{{$combustivel->id}}).classList.add('bg-danger');
        document.getElementById('valor').value = {{$combustivel->preco}};
        document.getElementById('combustivel').value = {{$combustivel->id}};

        function select(id, preco){
            if (document.getElementById('combustivel').value != id){
                if (document.getElementById('combustivel').value!=0) {
                    document.getElementById('card'+document.getElementById('combustivel').value).classList.remove('bg-danger');
                    document.getElementById('combustivel').value = 0;

                }
                document.getElementById('combustivel').value = id;
                document.getElementById('card'+id).classList.add('bg-danger');
                document.getElementById('valor').value = preco;
            } 
        }

        function atualizaQtd(id, preco){
            var qtd = document.getElementById('quantidade').value;
            document.getElementById('valor').value = qtd*preco;
        }

        function atualizaValor(id, preco){
            var valor = document.getElementById('valor').value;
            document.getElementById('quantidade').value = valor/preco;
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