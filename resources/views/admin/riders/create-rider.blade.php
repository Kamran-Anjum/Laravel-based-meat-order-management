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
                        <h5 class="font-medium text-uppercase mb-0">Add Rider</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Rider</li>
                            </ol>
                        </nav>
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
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/create-rider') }}" > {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">Create Rider</h5>
                                        <hr>
                                      
                                        <div class="row">
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Name</label>
                                                    <input required type="text" class="form-control" name="customer_name">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Email</label>
                                                    <input required type="text" class="form-control" name="customer_email">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Address</label>
                                                    <input required type="text" class="form-control" name="customer_address">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                    
                                                    <label  for="">Cell No</label>
                                                    <input required type="text" name="customer_cell" class="form-control" >
                                                   
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                      
                                      <div class="row">
                                              <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Customer Role</label>
                                                    <select required class="form-control" name="customer_role">
                                                       {!! $roles_dropdown !!}

                                                    </select>                                                    
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Profile Image (Optional)</label>
                                                    <input type="file" class="form-control" name="customer_image">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                              <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Password</label>
                                                    <input required type="text" class="form-control" name="password">                                                    
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Confirm Password</label>
                                                    <input required type="text" class="form-control" name="cpassword">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="1" id="customRadioInline1" checked="checked" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="0" id="customRadioInline2" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                                                  
                                    </div>

                                        <hr>
                                        <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                                        <a href="{{ url('/admin/view-riders')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
