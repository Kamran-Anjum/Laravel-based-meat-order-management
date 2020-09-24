@extends('layouts.adminLayout.admin-design')
@section('content')


    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-9" style="padding: 85px;">
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
                    <form method="post" action="{{ url('admin-change-pwd') }}" > {{ csrf_field() }}
                        <h2 class="text-uppercase" style="color: black;margin-bottom: 15px;">Change Password?</h2>
                        <div class="form-group"><input class="form-control form-control-sm" type="password" required="" style="width: 50%;" placeholder="Enter Current Password" id="currentPassword" name="currentPassword"></div>
                        <div class="form-group"><input class="form-control form-control-sm" type="password" required="" style="width: 50%;" placeholder="Enter New Password" id="newPassword" name="newPassword"></div>
                        <div class="form-group"><input class="form-control form-control-sm" type="password" required="" style="width: 50%;" placeholder="Confirm New Password" id="confirmPassword" name="confirmPassword"></div>
                        <button class="btn btn-primary btn-sm border rounded-0" type="submit" style="background-color: dodgerblue;border: none !important;">Update Password</button></form>
                </div>
            </div>
        </div>
    </div>


@endsection