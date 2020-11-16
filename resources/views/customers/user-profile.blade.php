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
                    <div class="col-lg-4 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0">Customer Profile</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Customer Profile</li>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
            <!-- Column -->
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                                <h5 class="card-title">Your Profile</h5>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>User Name</strong></label>
                                        <p>{{$users->name}}</p>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Email</strong></label>
                                        <p>{{$users->email}}</p>
                                    </div>
                                    
                                    <div class="col-md-4">
                                      @if(!empty($user_detail->profile_image))
                                        <img width="100" height="100" src=" {{ asset('/images/backend-images/halalmeat/customer/medium/'.$user_detail->profile_image ) }}">
                                        @else
                                        <img width="100" height="100" src=" {{ asset('/images/backend-images/halalmeat/customer/medium/'.$user_detail->profile_image ) }}">
                                        @endif
                                    </div>

                                  </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Address</strong></label>
                                        @if(!empty($user_detail->address))
                                        <p>{{$user_detail->address}}</p>
                                        @else
                                        <p>not found</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Cell No.</strong></label>
                                        @if(!empty($user_detail->cell_no))
                                        <p>{{$user_detail->cell_no}}</p>
                                        @else
                                        <p>not found</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Bio</strong></label>
                                        @if(!empty($user_detail->bio))
                                        <p>{{$user_detail->bio}}</p>
                                        @else
                                        <p>not found</p>
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <label class="control-label"><strong>Status</strong></label>
                                        @if($users->is_active == '1')
                                        <p>Active</p>
                                        @else
                                        <p>De-Active</p>
                                        @endif
                                    </div>
                                </div>
                                
                                <hr>
                                <div class="form-actions mt-5">
                                        <a href="{{ url('/user/edit-profile/'.$users->id)}}"><button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button><a>
                                        
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
