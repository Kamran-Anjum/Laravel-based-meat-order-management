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
                <h5 class="font-medium text-uppercase mb-0">Edit Coupons</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Coupons</li>
                    </ol>
                </nav>
            </div>
        </div>

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
                        @foreach($couponDetails as $coupon)
                        <form class="form-horizontal" method="post" action="{{ url('/admin/edit-coupon/'.$coupon->id) }}" name="add_coupon" id="add_coupon"> {{ csrf_field() }}
                            <div class="form-body">
                                <h5 class="card-title">About Coupon</h5>
                                <hr>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Coupon Name</label>
                                            <input required type="text" id="coupon_name" name="coupon_name" class="form-control" value="{{$coupon->coupon_name}}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Coupon Code</label>
                                            <input required type="text" id="coupon_code" name="coupon_code" class="form-control" value="{{$coupon->coupon_code}}" minlength="5" maxlength="15" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Amount</label>
                                            <input type="number" id="amount" name="amount" class="form-control" value="{{$coupon->amount}}" min="1" required> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Amount Type</label>
                                            <select name="amount_type" class="select2 form-control custom-select" id="amount_type" style="width: 100%;">
                                                <option @if($coupon->amount_type == "Percentage") selected @endif value="Percentage">Percentage</option>
                                                <option @if($coupon->amount_type == "Fixed") selected @endif value="Fixed">Fixed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Expiry Date</label>
                                            <input type="Date" id="expiry_date" name="expiry_date" class="form-control" value="{{$coupon->expiry_date}}" required> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Apply With Other Disscount</label>
                                            <select name="apply_with_other_dis" class="select2 form-control custom-select" id="apply_with_other_dis" style="width: 100%;">
                                                <option @if($coupon->apply_with_other_dis == "Yes") selected @endif value="Yes">Yes</option>
                                                <option @if($coupon->apply_with_other_dis == "No") selected @endif value="No">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <br/>
                                            @if($coupon->status == 1)
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="1" id="customRadioInline1" checked="checked" name="status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="0" id="customRadioInline2" name="status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                            </div>
                                            @else
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="1" id="customRadioInline1" name="status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input type="radio" value="0" id="customRadioInline2" checked="checked" name="status" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr> 

                                <input type="hidden" name="created_by" value="1">

                            </div>
                            <div class="form-actions mt-5">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button>
                                <a href="{{ url('/admin/view-coupons')}}"> <button type="button" class="btn btn-dark">Cancel</button></a>
                            </div>
                        </form>
                        @endforeach                         
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
