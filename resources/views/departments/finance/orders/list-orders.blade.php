@extends('layouts.financeLayout.finance-design')
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
                <!-- <div class="row">
                    <div class="col-12">
                        <div class="button-group">
                        <button type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('production/create-order') }}">Add New</a></button>
                    </div>
                    </div>
                </div> -->
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
                                                <!-- <th>Discount</th> -->
                                                <th>Periority</th>
                                                <th>Location</th>
                                                <th>Status</th>
                                                <th>Total Amount</th>
                                                <th>Ordered By</th>
                                                <th>Action</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{$order->id}}</td>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->email}}</td>
                                                <td>{{$order->cell_no}}</td>
                                                <!-- <td>${{$order->discount}}</td> -->
                                                <td>{{$order->pr_status}}</td>
                                                <td>{{$order->loc_status}}</td>
                                                <td>{{$order->s_status}}</td>
                                                <td>{{$order->total_amount}}</td>
                                                <td>{{$order->order_by}}</td>
                                                <td style="width: 20%">
                                                    <button type="button" class="btn waves-effect waves-light btn-info" data-toggle="modal" value="" data-target="#exampleModal" onclick="getSODetails({{ $order->id }})"><a class="text-white" href="#">View</a></button>
                                                    @if($order->status == "1" || $order->status == "7" || $order->status == "12")
                                                    <button type="button" disabled="" class="btn waves-effect waves-light btn-primary">Invoice</button>
                                                    @else
                                                        @if(!empty($order->fiken_invoice_id))
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('finance/get-order-invoice/'.$order->id) }}" target="_blank">Get Invoice</a></button>
                                                        <!-- <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ $order->invoice_url }}" target="_blank">Invoice</a></button> -->
                                                        @elseif($order->status == "5")
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('finance/order-invoice/'.$order->id) }}">Cerate Invoice</a></button>
                                                        @endif

                                                    @endif

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
                                                <!-- <th>Discount</th> -->
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
                                        <table id="forwardinfo" class="table border">
                                            <tbody>
                                                
                                                <!-- <tr>
                                                    <th>Product Name</th>
                                                    <th>Forward Qty</th>
                                                    <th>Balance QTY</th>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>Chicken</td>
                                                    <td>2</td>
                                                    <td>1</td>
                                                    
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
