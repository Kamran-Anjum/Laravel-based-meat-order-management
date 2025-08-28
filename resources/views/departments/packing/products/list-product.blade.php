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
                        <h5 class="font-medium text-uppercase mb-0">List Products</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List Products</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="button-group">
                        <button type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/create-product') }}">Add New</a></button>
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
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Image</th>
                                                <th>Inventory</th>
                                                <th>Quantity</th>
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($products as $product)
                                            <tr>
                                                <td>{{$product->code}}</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->categoryname}}</td>
                                                <td> <img src="{{ asset('/images/backend-images/liburtiimages/products/tiny/'.$product->image ) }}" width="80"> </td>
                                                <td>{{$product->inventoryType}}</td>
                                                <td>{{$product->quantity}}</td>
                                                <td>{{$product->created_at}}</td>
                                                <td>{{$product->userName}}</td>
                                                <td>
                                                    <button type="button" class="btn waves-effect waves-light btn-info"><a class="text-white" href="#">View</a></button>
                                                    <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('/admin/edit-product/'.$product->id)}}">Edit</a></button>
                                                    <button type="button" class="btn waves-effect waves-light btn-danger">  <a class="text-white sa-confirm-delete" param-id="{{ $product->id }}" param-route="delete-product" href="javascript:">Remove</a></button>

                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Image</th>
                                                <th>Inventory</th>
                                                <th>Quantity</th>
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Actions</th>
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
