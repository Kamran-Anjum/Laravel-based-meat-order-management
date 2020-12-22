@extends('layouts.productionLayout.production-design')
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
                        <h5 class="font-medium text-uppercase mb-0">Update Sales Order</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Update Sales Order</li>
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
                <style>
                    .select2-container--default .select2-selection--single .select2-selection__rendered {
                        color: #444;
                        line-height: 35px;
                    }
                    .select2-container .select2-selection--single {
                        box-sizing: border-box;
                        cursor: pointer;
                        display: block;
                        height: 35px;
                        user-select: none;
                        -webkit-user-select: none;
                    }
                    .select2-container--default .select2-selection--single {
                        background-color: #fff;
                        border: 1px solid #e9ecef;
                        border-radius: 4px;
                    }
                    .select2-container--default .select2-selection--single .select2-selection__arrow b {
                        border-color: #888 transparent transparent transparent;
                        border-style: solid;
                        border-width: 5px 4px 0 4px;
                        height: 0;
                        left: 50%;
                        margin-left: -4px;
                        margin-top: -2px;
                        position: absolute;
                        top: 60%;
                        width: 0;
                    }
                    .select2-container--default .select2-selection--multiple {
                        background-color: white;
                        border: 1px solid #e9ecef;
                        border-radius: 4px;
                        cursor: text;
                    }
                    .select2-container--default.select2-container--focus .select2-selection--multiple {
                        border:  1px solid rgba(0,0,0,.25);
                        outline: 0;
                    }
                    tbody td input{
                        border:none !important;
                    }
                    .hidden{
                        display: none;
                    }
                </style>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post" action="{{ url('/packing/forward-order/'.$sale_order->id) }}" > {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">Update Sales Order</h5>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label  for="">Customer Name</label>
                                                    <input name="order_date" value="{{$sale_order->customer_name}}" type="text" class="form-control" disabled>
                                                    <input type="hidden" id="od_id" value="{{$sale_order->id}}">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                           
                                            </div>
                                          	 <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Sales Date</label>
                                                    <input name="order_date" value="{{$sale_order->created_at}}" type="text" class="form-control" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                     
                                         
                                       <div class="table-responsive">
                                    <table  class="table table border" id="dataTable2" >
                                        <thead>
                                            <tr>
                                            	
        
                                                <th>Product</th>
                                                <th>SKU</th>
                                                <th>Qty</th>
                                                <th>Sale Price</th>
                                                
                                                <th>SubTotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($order_details as $order_dtl)
                                            <tr>
                                                <td>
                                             <input disabled type="text" value="{{$order_dtl->product_name}}" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                            <input disabled type="text" value="{{$order_dtl->sku_number}}" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                                 <input disabled type="text" value="{{$order_dtl->quantity}}" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                              <input disabled type="text" value="{{$order_dtl->price}}" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                              <input disabled type="text" value="{{$order_dtl->total_amount}}" class="form-control" placeholder="Category">
                                         		</td>
                                            </tr>
                                           @endforeach
                                        </tbody>
                                      
                                    </table>
                                    
                                </div>
                          
                                       
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Status</label>
                                                    <input disabled type="text" value="{{$sale_order->status}}" class="form-control" placeholder="Category">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Forward To</label>
                                                    <select id="dept_status" name="dept_status" class="form-control">
                                                        {!! $location_dropdown !!}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Total Amount</label>
                                                    <input disabled value="{{$sale_order->total_amount}}" id="total_price" readonly value="0" required type="number" class="form-control" ></div>
                                            </div>
                                            
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Forward</button>
                                        <a href="{{ url('/production/view-wp-orders')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
