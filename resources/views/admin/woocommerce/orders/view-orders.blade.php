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
                                                <th>Wp Order ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <!-- <th>Cell No</th> -->
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Department</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1; ?>
                                        @foreach($db_wp_orders as $order)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$order->wp_order_id}}</td>
                                                <td>{{$order->customer_name}}</td>
                                                <td>{{$order->customer_email}}</td>
                                                <!-- <td>{{$order->customer_cell}}</td> -->
                                                <td>{{$order->total_amount}}</td>
                                                <td>{{$order->status}}</td>
                                                <td>{{$order->locatin_name}}</td>
                                                <td>{{$order->delivery_status}}</td>
                                                
                                                <td style="width: 25%">
                                                    <button type="button" class="btn waves-effect waves-light btn-info" data-toggle="modal" value="" data-target="#exampleModal" onclick="getSODetails({{ $order->id }})"><a class="text-white" href="#">View</a></button>
                                                    @if($order->location_status != 1)
                                                    <button type="button" disabled class="btn waves-effect waves-light btn-primary"><a class="text-white">Forward</a></button>
                                                    @else
                                                    <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('admin/forward-wp-order/'.$order->id) }}">Forward</a></button>
                                                    @endif
 
                                                </td>
                                                <td><button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('admin/update-wp-order/'.$order->wp_order_id) }}">Update</a></button></td>
                                            </tr>
                                            <?php $i = $i+1; ?>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Wp Order ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <!-- <th>Cell No</th> -->
                                                <th>Total Amount</th>
                                                <th>Status</th>
                                                <th>Department</th>
                                                <th>Delivery Status</th>
                                                <th>Action</th>
                                                <th></th>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog col-8" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Sale Order</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!--Accordion wrapper-->
<div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

  <!-- Accordion card -->
  <div class="card">

    <!-- Card header -->
    <div class="card-header" role="tab" id="headingOne1">
      <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
        aria-controls="collapseOne1">
        <h5 class="mb-0">
          Sale Order Detail<i class="fas fa-angle-down rotate-icon"></i>
        </h5>
      </a>
    </div>

    <!-- Card body -->
    <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
      data-parent="#accordionEx">
      <div class="card-body">
       <div class="table-responsive">
                                        <table id="Suppinfo" class="table border">
                                            <tbody>
                                                
                                                <!-- <tr>
                                                    <th>Supplier Info:</th>
                                                    <th>P.O # 23:</th>
                                                </tr> -->
                                                <tr>
                                                    <td><strong>Name:</strong> abc</td>
                                                    <td><strong>Contant number:</strong> 123</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Email:</strong> abc</td>
                                                    <td><strong>Supplier Image:</strong> <img width="75" height="75" src="{{ asset('images/backend-images/favicon.png') }}"></td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Supplier Address:</strong></td>
                                                    <td>dfdfgffdh</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>City:</strong> abc</td>
                                                    <td><strong>State:</strong> abc</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Country:</strong> abc</td>
                                                    <td><strong>Status:</strong> abc</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Created By:</strong> abc</td>
                                                    <td><strong>Created At:</strong> abc</td>
                                                </tr>
                                                </tbody>
                                        
                                    </table>

                                                <table id="productinfo" class="table border">
                                            <tbody>
                                                
                                                <!-- <tr>
                                                    <th>Product Name</th>
                                                    <th>Rec. QTY</th>
                                                    <th>Demand QTY</th>
                                                    <th>Price</th>
                                                    <th>Amount</th>
                                                </tr>
                                                <tr>
                                                    <td>Chicken</td>
                                                    <td>2</td>
                                                    <td>1</td>
                                                    <td>22</td>
                                                    <td>22</td>
                                                </tr> -->
                                        </tbody>
                                        
                                    </table>
                                </div>
      </div>
    </div>

  </div>
</div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

@endsection
