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
                        <a href="{{ url('admin/create-product') }}"><button type="button" class="btn waves-effect waves-light btn-success">Add New</button></a>
                    </div>
                    </div>
                </div>
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block">
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
<!--                                 <h4 class="card-title">Zero Configuration</h4>
                                <h6 class="card-subtitle">DataTables has most features enabled by default, so all you
                                    need to do to use it with your own tables is to call the construction
                                    function:<code> $().DataTable();</code>. You can refer full documentation from here
                                    <a href="https://datatables.net/">Datatables</a></h6> -->
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped border">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>SKU No.</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Base Price</th>                                               
                                                <th>Image</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach($products as $product)
                                            <tr>
                                            
                                               
                                                <td>{{$product->id}}</td>
                                                <td>{{$product->sku_number}}</td>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->catname}}</td>
                                                <td>{{$product->name}}</td>
                                                <td>Rs.{{$product->base_price}}</td>
                                                <td><img width="50" height="50" src=" {{ asset('/images/backend-images/halalmeat/products/tiny/'.$product->image ) }}"></td>
                                                <td>{{$product->userName}}</td>
                                                @if($product->is_active == '1')
                                                <td>Active</td>
                                                @else
                                                <td>De-Active</td>
                                                @endif
                                                <!-- <td>$320,800</td> -->
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button" class="btn waves-effect waves-light btn-info"><a class="text-white" href="{{ url('/admin/view-product-details/'.$product->id)}}">ViewStock</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('admin/edit-product/'.$product->id) }}">Edit</a></button>
                                                        <!-- <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{ $product->id }}" param-route="delete-fabric" href="javascript:">Remove</a></button> -->

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                             
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>SKU No.</th>
                                                <th>Name</th>
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Base Price</th>                                               
                                                <th>Image</th>
                                                <th>Created By</th>
                                                <th>Status</th>
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
