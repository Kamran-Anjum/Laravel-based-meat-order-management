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
                        <h5 class="font-medium text-uppercase mb-0">Edit Cities</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Cities</li>
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

                                @foreach($cityDetails as $city)

                                <form enctype="multipart/form-data" class="form-horizontal" method="post" action="{{ url('/admin/edit-cities/'.$city->id) }}" name="edit_city" id="edit_city" novalidate="novalidate"> {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">About Cities</h5>
                                        <hr>

                                        <div class="row">

                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label for="">Country *</label>
                                                        <select class="select2 form-control custom-select" name="countries_id" id="countries_id" style="width: 100%; height:36px;" required="">
                                                        @foreach($countries as $cont)
                                                            <option @if($cont->id == $city->countries_id) selected="true" @endif  value="{{$cont->id}}">{{$cont->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label for="">State *</label>
                                                        <select class="select2 form-control custom-select" name="states_id" id="states_id" style="width: 100%; height:36px;" required="">
                                                        @foreach($states as $stat)
                                                            <option @if($stat->id == $city->states_id) selected="true" @endif  value="{{$stat->id}}">{{$stat->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code</label>
                                                    <input type="text" id="code" name="code" class="form-control" value="{{$city->code}}"></div>
                                            </div>

                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input type="text" id="name" name="name" class="form-control" value ="{{$city->name}}"> </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Short Name</label>
                                                    <input type="text" id="short_name" name="short_name" class="form-control" value="{{$city->short_name}}"> </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">City Longitutde</label>
                                                    <input type="text" id="longitude" name="longitude" class="form-control" value="{{$city->longitude}}"> 
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">City Latitude</label>
                                                    <input type="text" id="latitude" name="latitude" class="form-control" value="{{$city->latitude}}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>

                                                    @if($city->is_active == 1)

                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="1" id="customRadioInline1" checked="checked" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="0" id="customRadioInline2" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                                    </div>

                                                    @else
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="1" id="customRadioInline1" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="0" id="customRadioInline2" checked="checked" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                                    </div>

                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                        <hr> 

                                        @endforeach

                                    </div>
                                    <div class="form-actions mt-5">
                                        <button type="submit" value="Add City" class="btn btn-success"> <i class="fa fa-check"></i> Edit </button>
                                        <a href="{{ url('/admin/view-cities')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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