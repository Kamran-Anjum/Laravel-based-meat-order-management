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
                        <h5 class="font-medium text-uppercase mb-0">Add Product</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/create-asset') }}" > {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">Create Asset</h5>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Category</label>
                                                    <select class="form-control" id="asset_category_id" name="asset_category_id">
                                                        {!! $categories_dropdown !!}
                                                    </select>                                                    
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Sub Category</label>
                                                    <select name="assetsubcategory" id="assetsubcategory" class="form-control" disabled="" style="width: 100%; height:36px;" required>
                                            </select>                                                  
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                        </div>
                                      
                                        <div class="row">
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Name</label>
                                                    <input type="text" class="form-control" name="asset_name">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Document Number</label>
                                                    <input type="text" class="form-control" name="doc_no">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Amount</label>
                                                    <input type="number" class="form-control" name="amount">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                    
                                                    <label  for="">Tax Amount</label>
                                                    <input type="number" class="form-control" name="tax">
                                                   
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                      
                                      <div class="row">
                                              
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Total Amount</label>
                                                    <input type="number" class="form-control" name="total_amount">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Status</label>
                                                    <input type="text" name="status" class="form-control" readonly="" value="Purchased">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                        </div>
                                        
                                        <div class="row">
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Registration Number</label>
                                                    <input type="text" class="form-control" name="reg_no">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Engine Number</label>
                                                    <input type="text" class="form-control" name="engine_no">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Chasis Number</label>
                                                    <input type="text" class="form-control" name="chasis_no">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Image</label>
                                                    <input type="file" class="form-control" name="vehicle_image">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>                     
                                    </div>

                                        <hr>
                                        <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                                        <a href="{{ url('/admin/view-assets')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
