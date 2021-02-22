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
                                            <th>Opções</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Código</th>
                                            <th>Combustíveis</th>
                                            <th>Opções</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>Gasolina Aditivada</td>
                                            <td><a class="btn btn-secondary" href="./editarbomba.html" role="button">Editar</a>
                                            <button type="button" class="btn btn-secondary">Deletar</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>Gasolina Comum</td>
                                            <td><a class="btn btn-secondary" href="./editarbomba.html" role="button">Editar</a>
                                            <button type="button" class="btn btn-secondary">Deletar</td>
                                        </tr>
                                    
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
    @endsection
                  