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
                        <h5 class="font-medium text-uppercase mb-0">Product Details</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Products Details</li>
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
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                                <h5 class="card-title">About Products</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Product Name</strong></label>
                                        <p>{{$products->name}}</p>
                                    </div>
                                    <div class="col-md-2">
                                        <label class="control-label"><strong>Category Name</strong></label>
                                        <p>{{$products->catName}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <img width="100" height="100" src=" {{ asset('/images/backend-images/halalmeat/products/large/'.$products->image ) }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>SKU Number</strong></label>
                                        <p>{{$products->sku_number}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Base Price</strong></label>
                                        <p>{{$products->base_price}}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Available Stock</strong></label>
                                        <p>{{$product_total_stocks->balanced_qty}}</p>
                                    </div>
                                    <div class="col-md-4">
                                    <label class="control-label"><strong>Sell Stock</strong>
                                        <p>{{$product_total_stocks->sale_qty}}</p>
                                    </div>
                                    
                                </div>
                                <hr>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
                <div class="row">
                    <div class="col-12">
                        <div class="material-card card">
                            <div class="card-body">
                                <h4 class="card-title">Stock History</h4>
                               <!--  <h6 class="card-subtitle">DataTables has most features enabled by default, so all you
                                    need to do to use it with your own tables is to call the construction
                                    function:<code> $().DataTable();</code>. You can refer full documentation from here
                                    <a href="https://datatables.net/">Datatables</a></h6> -->
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped border">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>P.O #.</th>
                                                <th>Supplier Name</th>
                                                <th>Product Name</th>
                                                <th>Demand Qty</th>
                                                <th>Recieve Qty</th>                           
                                                <th>Recieved By</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1; ?>
                                        @foreach($stock_detail as $stock)
                                            <tr>
                                            
                                               
                                                <td>{{$i}}</td>
                                                <td>{{$stock->ponumber}}</td>
                                                <td>{{$stock->suppName}}</td>
                                                <td>{{$stock->productName}}</td>
                                                <td>{{$stock->demand_quantity}}</td>
                                                <td>{{$stock->recieved_quantity}}</td>
                                                @if(!empty($stock->recieved_by))
                                                <?php $user = DB::table('users')->where(['id'=> $stock->recieved_by])->first(); ?>
                                                <td>{{$user->name}}</td>
                                                @else
                                                <td>Still Not Recieved</td>
                                                @endif
                                                <!-- <td>$320,800</td> -->

                                            </tr>
                                            <?php $i = $i+1; ?> 
                                        @endforeach
                                             
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>P.O #.</th>
                                                <th>Supplier Name</th>
                                                <th>Product Name</th>
                                                <th>Demand Qty</th>
                                                <th>Recieve Qty</th>                           
                                                <th>Recieved By</th>
                                                

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
