@extends('layouts.design')
@section('content')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Nova Bomba</h1>
                    </div>

                    <div class="row">

                        <!-- Area Chart -->
                        <div class="col-xl-12 col-lg-12">
                            <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-danger">Adicionar Bomba</h6>
                        </div>
                        <div class="card-body">
                            <form>
                                <div class="row justify-content-center">
                                    <div class="col-md-5">
                                         <div class="form-group">
                                            <label class="bmd-label-floating">Número</label>
                                            <input type="text" class="form-control">
                                        </div>
                                    </div>
                                    @foreach ($combustiveis as $combustivel)
                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" value="{{$combustivel->id}}" name='combustiveis[]'>
                                                  <label class="form-check-label" >
                                                    {{$combustivel->combustivel}}
                                                  </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="col-md-3 align-self-center ">
                                         <div class="form-group">
                                          <input type="submit" value="Adicionar" class="btn btn-secondary">
                                        </div>
                                    </div>
                                        
                                </div>
                                
                            </form>
                        </div>
                    </div>
            </div>
    
@endsection
                    

    