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
                <h5 class="font-medium text-uppercase mb-0">Edit Orderprocess Codes</h5>
            </div>
            <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                    <ol class="breadcrumb mb-0 justify-content-end p-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Orderprocess Codes</li>
                    </ol>
                </nav>
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
                        @foreach($orderprocess_codes as $orderprocess_code)
                        <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-orderprocess-code/'.$orderprocess_code->id) }}" name="edit_orderprocess_codes" id="edit_orderprocess_codes"> {{ csrf_field() }}
                            <div class="form-body">
                                <h5 class="card-title">About Orderprocess Codes</h5>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label  class="control-label">Category</label>
                                                <select class="select2 form-control custom-select" name="category_code" id="category_code" style="width: 100%; height:36px;" required>
                                                    
                                                    {!! $categories_dropdown !!}
                                                </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Orderprocess Code</label>
                                            <input required type="text" id="orderprocess_code" name="orderprocess_code" value="{{ $orderprocess_code->orderprocess_code }}" class="form-control" placeholder=""> 
                                        </div>
                                    </div>
                                </div>
                                                                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <br/>
                                        @if($orderprocess_code->status == 1)
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input  checked="checked" value="1" name="status" type="radio" id="customRadioInline1"
                                                name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input  name="status" value="0" type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input value="1" name="status" type="radio" id="customRadioInline1"
                                                name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline1">Active</label>
                                            </div>
                                            <div class="custom-control custom-radio custom-control-inline">
                                                <input checked="checked" value="0" name="status" type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                <hr> 
                            </div>
                            <div class="form-actions mt-5">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button>
                                <a href="{{ url('/admin/view-orderprocess-codes')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
