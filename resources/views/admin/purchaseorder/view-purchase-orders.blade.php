@extends('layouts.adminLayout.admin-design')
@section('content')
<style type="text/css">
    .modal.show .modal-dialog {
    transform: none;
    max-width: 80% ;
}
</style>
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
                        <h5 class="font-medium text-uppercase mb-0">List Purchase Orders</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List Purchase Orders</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="button-group">
                        <a href="{{ url('admin/create-purchase-order') }}"><button type="button" class="btn waves-effect waves-light btn-success">Add New</button></a>
                    </div>
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
                                                <th>Supplier Name</th>
                                                
                                                <th>Total Amount</th>                                 
                                                <th>Periority</th>
                                                <th>Created By</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        
                                        @foreach($purchase_orders as $purchase_order)
                                            <tr>
                                            
                                               
                                                <td>{{$purchase_order->id}}</td>
                                                <td>{{$purchase_order->suppName}}</td>
                                                
                                                <td>{{$purchase_order->total_amount}}</td>
                                                <td>{{$purchase_order->prStatus}}</td>
                                                <td>{{$purchase_order->userName}}</td>
                                                <td>{{$purchase_order->status}}</td>
                                                
                                                <td>
                                                    <div class="button-group">
                                                        
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a target="_blank" class="text-white" href="{{ url('/admin/poinvoice/'.$purchase_order->id)}}">PDF</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-info" data-toggle="modal" value="" data-target="#exampleModal" onclick="getPODetails({{ $purchase_order->id }})" >P.O Detail</button>
                                                        <button type="button" class="btn waves-effect waves-light btn-warning"><a class="text-white" href="{{ url('admin/edit-purchase-order/'.$purchase_order->id) }}">Edit</a></button>

                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Supplier Name</th>
                                                <th>Total Amount</th>                                 
                                                <th>Periority</th>
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
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog col-8" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Purchase Order</h5>
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
          Purchase Order Detail<i class="fas fa-angle-down rotate-icon"></i>
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
                                                    <td><strong>Supplier Name:</strong> abc</td>
                                                    <td><strong>Contant number:</strong> 123</td>
                                                </tr>
                                                <tr>
                                                    <td><strong>Supplier Email:</strong> abc</td>
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
