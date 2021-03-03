@extends('layouts.design')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Index - Bombas</h1>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                                <button title="Nova bomba" class="btn btn-secondary " onclick="window.location.href='{{route('bomba.create')}}'">Nova bomba</button>
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Bombas Cadastradas</h6>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Código</th>
                                            <th>Combustíveis</th>
                                            <th>Status</th>
                                            <th>Opções</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Combustíveis</th>
                                            <th>Status</th>
                                            <th>Opções</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($bombas as $bomba)
                                        <tr>
                                            <td>{{$bomba->codigo}}</td>
                                            <td>@foreach ($combustiveis as $combustivel)
                                                @if($bomba->id == $combustivel->id_bomba)
                                                    {{$combustivel->combustivel}}<br>
                                                @endif
                                            @endforeach
                                            </td>
                                            <td>@if($bomba->trashed())Inativa @else Ativa @endif</td>
                                            <td>@if(!$bomba->trashed())
                                                <button title="Editar" class="btn btn-secondary " onclick="window.location.href='{{route('bomba.edit', [$bomba->id])}}'">Editar</button>
                                             <form action="{{route('bomba.destroy', [$bomba->id])}}" method="POST" style="display: inline;">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button title="Desativar" class="btn btn-secondary " type="submit" name="action">Desativar</button>
                                                  </form>
                                                @else
                                                    <form action="{{route('bomba.restore', [$bomba->id])}}" method="POST" style="display: inline;">
                                                      @csrf
                                                      @method('PUT')
                                                      <button title="Ativar" class="btn btn-secondary" type="submit" name="action">Ativar</button>
                                                  </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
    @endsection
                  