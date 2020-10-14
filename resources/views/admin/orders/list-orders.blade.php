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
                    <div class="col-lg-4 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0">List Orders</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List Orders</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="button-group">
                        <button type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/create-order') }}">Add New</a></button>
                    </div>
                    </div>
                </div>
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>

                @endif
                @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                @endif
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
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="material-card card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped dataTable product-overview" id="zero_config">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Cell No</th>
                                                <th>Discount</th>
                                                <th>Periority</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Total Amount</th>
                                                <th>Ordered By</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $product)
                                            <tr>
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->first_name}} {{$product->last_name}}</td>
                                                <td>{{$product->email}}</td>
                                                <td>{{$product->cell_no}}</td>
                                                <td>${{$product->discount}}</td>
                                                <td>{{$product->pr_status}}</td>
                                                <td>{{$product->loc_status}}</td>
                                                <td>{{$product->s_status}}</td>
                                                <td>{{$product->total_amount}}</td>
                                                <td>{{$product->order_by}}</td>
                                                <td>
                                                    <button type="button" class="btn waves-effect waves-light btn-info"><a class="text-white" href="#">View</a></button>
                                                    <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="#">Edit</a></button>
                                                    <button type="button" class="btn waves-effect waves-light btn-danger">  <a class="text-white sa-confirm-delete" param-id="{{ $product->id }}" param-route="delete-product" href="#">Remove</a></button>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Cell No</th>
                                                <th>Discount</th>
                                                <th>Periority</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Total Amount</th>
                                                <th>Ordered By</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
