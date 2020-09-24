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
                        <h5 class="font-medium text-uppercase mb-0">Assign Promotion To Prodcts</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assign Promotion</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block">
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


                <!-- <div class="row">
                    <div class="col-12">
                    	<div class="button-group">
					    <a href="{{ url('/admin/create-promotions') }}"><button type="button" class="btn waves-effect waves-light btn-success">Add New Promotion</button></a> 
					</div>
                    </div>
                </div>
            </div> -->
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
                                    <table id="zero_config" class="table table-striped border">
                                        <thead>
                                            <tr>
                                                <th>Prduct Name</th>                                  
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Price</th>
                                                <th>sale Price</th>
                                                <th>Image</th>
                                                <th>Assign</th>
                                            </tr>
                                        </thead>

                                        <tbody>

                                        @foreach($productDetails as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->categories_id}}</td>
                                                <td>{{$product->subcategories_id}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->saleprice}}</td>
                                                <td>{{$product->image}}</td>
                                                <td>
                                                	<div class="button-group">

														<button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('admin/edit-promotions/'.$product->id) }}">Edit</a></button>

                                                        <button type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/assign-promotions/'.$product->id) }}">Assign To Products</a></button>

														<button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{ $promotion->id }}" param-route="delete-promotion" href="javascript:">Remove</a></button>
													</div>
												</td>

                                            </tr>
                                        @endforeach

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Prduct Name</th>                                  
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Price</th>
                                                <th>sale Price</th>
                                                <th>Image</th>
                                                <th>Assign</th>
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
