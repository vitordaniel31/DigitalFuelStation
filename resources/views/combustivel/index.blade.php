@extends('layouts.design')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Index Combustíveis</h1>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Combustíveis Cadastrados</h6>
                        </div>
                        <div class="card-body">
                            @foreach (['danger', 'success'] as $msg)
                                @if(Session::has('alert-' . $msg))
                                  <div class="alert alert-{{ $msg }}" role="alert">
                                    {{ Session::get('alert-' . $msg) }}
                                  </div>
                                @endif
                            @endforeach
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Preço</th>
                                            <th>Capacidade</th>
                                            <th>Quantidade restante</th>
                                            <th>Opções</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Preço</th>
                                            <th>Capacidade</th>
                                            <th>Quantidade restante</th>
                                            <th>Opções</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($combustiveis as $combustivel)
                                        <tr>
                                            <td>{{$combustivel->combustivel}}</td>
                                            <td>R$ {{$combustivel->preco}}</td>
                                            <td>{{$combustivel->capacidade}} Litros</td>
                                            <td>{{$combustivel->qtd_restante}} Litros</td>
                                            <td><button title="Editar" class="btn btn-secondary " onclick="window.location.href='{{route('combustivel.edit', [$combustivel->id])}}'">Editar</i></button>
                                            <button type="button" class="btn btn-secondary">Deletar</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
       @endsection