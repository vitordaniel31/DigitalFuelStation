@extends('layouts.design')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Abastecimento</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->

                        <div class="col-xl-12 col-md-12 mb-12 " >
                            @foreach (['danger', 'success'] as $msg)
                                        @if(Session::has('alert-' . $msg))
                                          <div class="alert alert-{{ $msg }}" role="alert">
                                            {{ Session::get('alert-' . $msg) }}
                                          </div>
                                        @endif
                                    @endforeach
                            <div class="card border-left-danger shadow h-100 py-2">
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
                                                            style="width: {{number_format(($combustivel->qtd_restante/$combustivel->capacidade)*100, 2, ',', '')}}%" aria-valuenow="{{($combustivel->qtd_restante/$combustivel->capacidade)*100}}" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <small>{{intval($combustivel->qtd_restante)}}/{{intval($combustivel->capacidade)}} litros</small>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-gas-pump fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="card-body">
                            <form method="POST" action="{{route('combustivel.abastecimento', [$combustivel->id])}}">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Quantidade (Litros)</label>
                                            <input name="quantidade" id="quantidade" type="text" class="form-control">
                                            @error('quantidade')
                                                <div class="alert alert-primary" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="form-group">
                                      <input type="submit" value="Abastecer" class="btn btn-secondary">
                                    </div>
                                </div>
                            </form>
                        </div>
            </div>
            <script src="https://code.jquery.com/jquery-1.10.0.min.js"></script>
             <script type='text/javascript' src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
            <script type="text/javascript">
                $('#quantidade').inputmask('decimal', {
                   mask: "9{1,6}.9{0,2}",
                   max: {{$combustivel->capacidade-$combustivel->qtd_restante}}
                });
            </script>
       
@endsection