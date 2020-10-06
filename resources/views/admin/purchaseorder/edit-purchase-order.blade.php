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
                        <h5 class="font-medium text-uppercase mb-0">List Required Demand</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List Required Demand</li>
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
                </style>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-purchase-order/'.$po->id) }}" > {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">Add Demand Reqiured</h5>
                                        <hr>

                                        <div class="row">
                                            
                                      
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                <label  for="">Supplier</label>
                                                <input class="form-control" type="text" name="" value="{{$po->suppName}}" readonly="">
                                                <input type="hidden" name="poid" id="poid" value="{{$po->id}}">                                          
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Product</label>
                                                     <select name="products_id[]" id="purchaseproducted" class="form-control custom-select select2" multiple>
                                                    {!! $product_dropdown !!}
                                                </select>
                                                                                       
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="dynamicqtyed">
                                            <?php $x = 1; ?>
                                            @foreach($purchase_orders_detail as $pod)
                                            <div class="row">
                                                <div class="col-md-4 mb-0">
                                                    <div class="form-group">
                                                        <label  for="">Price Product-{{$x}}</label>
                                                        <input value="{{$pod->price}}" required type="number" name="price[]" class="form-control">
                                                        <input type="hidden" name="pod_id[]" value="{{$pod->id}}">
                                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-0">
                                                    <div class="form-group">
                                                        <label  for="">Quantity Product-{{$x}}</label>
                                                        <input value="{{$pod->demand_quantity}}" required type="number" name="quantity[]" class="form-control">
                                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php $x = $x + 1; ?>
                                            @endforeach
                                        </div>
                                           
                                    </div>
                                         <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Order Note</label>
                                                    <textarea name="order_note" class="form-control" cols="4" rows="5">{{$po->order_note}}</textarea>                                                    
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                <label  for="">Priority</label>
                                                <select name="periority" id="" class="form-control ">
                                                    {!! $pr_statuses_dropdown !!}
                                                </select>
                                                                                                    
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                      
                                        </div>
                                    
                                    

                                        <hr>
                                        <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                                        <a href="{{ url('/admin/view-pruchase-orders')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
                                    </div>
                                           </form>

                                    </div>
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
