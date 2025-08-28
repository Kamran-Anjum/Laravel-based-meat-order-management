@extends('layouts.adminLayout.admin-design')
@section('content')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0">Edit Expence</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Expence</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="page-content container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-expence/'.$expences->id) }}" > {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">About Expence</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input required type="text" value="{{$expences->name}}" id="e_name" name="e_name" class="form-control" placeholder=""></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="card-title">Expence Type
                                                </h4>
                                                <div class="form-group">
                                                    <select class="form-control" id="mts-monograms" name="e_type" style="width: 100%;height: 36px;">
                                                        {!! $expence_dropdown !!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Amount</label>
                                                    <input required value="{{$expences->amount}}" type="number" id="e_price" name="e_price" class="form-control" placeholder=""></div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input name="image" type="file" class="form-control-file" id="exampleInputFile">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{$expences->id}}" param-route="delete-expence-image" href="javascript:">Remove</a></button>
{{--                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-deletes" param-id="{{$expences->id}}" param-route="delete-expence-image" href="javascript:">Remove</a></button>--}}
                                            
                                            <input type="hidden" name="current_image" value="{{ $expences->image }}">
                                            @if(!empty( $expences->image ))
                                                <img src="{{ asset('images/backend-images/halalmeat/expence/tiny/'.$expences->image ) }}" width="80">
                                            @endif
                                        </div>
                                    </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button>
                                        <a href="{{ url('/admin/view-Expences')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
@endsection
