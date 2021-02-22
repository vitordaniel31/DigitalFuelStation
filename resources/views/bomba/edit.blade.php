@extends('layouts.design')
@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Editar Bomba</h1>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Editar</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row">
                                    <div class="col-md-5">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Número</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Combustível 1</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Combustível 2</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <a class="btn btn-secondary" href="./indexbomba.html" role="button">Salvar</a>
                            </form>
                        </div>
                    </div>
            </div>
@endsection