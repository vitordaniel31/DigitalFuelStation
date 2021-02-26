@extends('layouts.design')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        @foreach ($combustiveis as $combustivel)
                        <div class="col-xl-4 col-md-6 mb-4 " onclick="window.location.href='{{route('combustivel.abastecer', [$combustivel->id])}}'">
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
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                        

                        
                    </div>

                    <!-- Content Row -->

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Vendas</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Data/Hora</th>
                                            <th>Combustível</th>
                                            <th>Bomba</th>
                                            <th>Quantidade (Litros)</th>
                                            <th>Valor (R$)</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Data/Hora</th>
                                            <th>Combustível</th>
                                            <th>Bomba</th>
                                            <th>Quantidade (Litros)</th>
                                            <th>Valor (R$)</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($vendas as $venda)
                                        <tr>
                                            <td>{{date('H:i:s Y/m/d', strtotime($venda->created_at))}}</td>
                                            <td>{{$venda->combustivel}}</td>
                                            <td>{{$venda->codigo}}</td>
                                            <td>{{$venda->litros_comprados}} Litros</td>
                                            <td>R$ {{$venda->valor}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
       
@endsection