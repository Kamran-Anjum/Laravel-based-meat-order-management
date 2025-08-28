@extends('layouts.adminLayout.admin-design')
@section('content')

<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-xs-12 align-self-center">
                <!-- <h5 class="font-medium text-uppercase mb-0">Add Branch</h5> -->
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Change Password</li>
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
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <!-- Column -->
            <div class="col-lg-12">

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

                <div class="card">
                    <div class="card-body">
                        <form method="post" action="{{ url('/admin/change-pwd') }}" > {{ csrf_field() }}
                        <h2 class="text-uppercase" style="color: black;margin-bottom: 15px;">Change Password?</h2>
                        <div class="form-group">
                            <input class="form-control" type="password" required="" style="width: 50%;" placeholder="Enter Current Password" id="currentPassword" name="currentPassword">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" required="" style="width: 50%;" placeholder="Enter New Password" id="newPassword" name="newPassword">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="password" required="" style="width: 50%;" placeholder="Confirm New Password" id="confirmPassword" name="confirmPassword">
                        </div>
                        <button class="btn btn-primary border rounded-0" type="submit" style="background-color: dodgerblue;border: none !important;">Update Password</button>
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

@endsection