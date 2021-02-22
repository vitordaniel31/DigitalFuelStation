@extends('layouts.design')
@section('content')
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Novo Combustível</h1>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Adicionar Combustível</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{route('combustivel.store')}}">
                                @csrf
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Combustível</label>
                                            <input name="combustivel" type="text" class="form-control">
                                            @error('combustivel')
                                                <div class="alert alert-primary" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Preço</label>
                                            <input type="text" name="preco" class="form-control">
                                            @error('preco')
                                                <div class="alert alert-primary" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Capacidade</label>
                                            <input type="text" name="capacidade" class="form-control">
                                            @error('capacidade')
                                                <div class="alert alert-primary" role="alert">
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
        @endsection