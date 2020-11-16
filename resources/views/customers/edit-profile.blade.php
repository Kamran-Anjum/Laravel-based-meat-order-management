@extends('layouts.customerLayout.customer-design')
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
                        <h5 class="font-medium text-uppercase mb-0">User Profile</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
                                <form enctype="multipart/form-data" method="post" action="{{ url('/user/edit-profile/'.$users->id) }}" > {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">Edit Profile</h5>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">User Name</label>
                                                    <input value="{{$users->name}}" type="text" class="form-control" name="product_name" readonly>
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Email</label>
                                                     <input type="email" readonly class="form-control" value="{{$users->email}}" name="product_name">
                                                     <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                        </div>
                                      
                                        <div class="row">
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Cell No</label>
                                                    <input value="{{$user_detail->cell_no}}" type="text" class="form-control" name="customer_cell">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Address</label>
                                                    <input value="{{$user_detail->address}}" type="text" class="form-control" name="customer_address">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Bio</label>
                                                    <textarea name="description" class="form-control" rows="5" cols="5">{{$user_detail->bio}}</textarea>
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                      
                                      <div class="row">
                                              
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Profile Image</label>
                                                    <input type="file" class="form-control" name="image">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-deletes" param-id="{{$users->id}}" param-route="delete-customer-image" href="javascript:">Remove</a></button>
{{--                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-deletes" param-id="{{$users->id}}" param-route="delete-customer-image" href="javascript:">Remove</a></button>--}}
                                            <input type="hidden" name="current_image" value="{{ $user_detail->profile_image }}">
                                            @if(!empty( $user_detail->profile_image ))
                                                <img src="{{ asset('images/backend-images/halalmeat/customer/tiny/'.$user_detail->profile_image ) }}" width="80">
                                            @endif
                                        </div>
                                    </div>                
                                    </div>

                                        <hr>
                                        <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button>
                                        <a href="{{ url('/user/profile')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
