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
                        <h5 class="font-medium text-uppercase mb-0">Edit Monogram</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Monogram</li>
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
                                @foreach($monograms as $monogram)
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-monogram/'.$monogram->id) }}" name="edit_monogram" id="edit_monogram"> {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">About Monogram  Type</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code</label>
                                                    <input value="{{$monogram->code}}" type="text" id="code" name="code" class="form-control" placeholder="" required=""></div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Initial</label>
                                                    <input value="{{$monogram->initial}}" id="initial" name="initial" type="text" id="lastName" class="form-control" placeholder="" required> </div>
                                            </div>
                                            <!--/span-->
                                        </div>


                                    <div class="row">
                                        <div class="col-md-6 mb-0">
                                            <div class="form-group">
                                                <label  for="">Color *</label>
                                                    <select class="select2 form-control custom-select" name="colors_id" id="colors_id" style="width: 100%; height:36px;" required>
                                                    @foreach($colors as $color)
                                                            <option @if($color->id == $monogram->attributes_id) selected="true" @endif  value="{{$color->id}}">{{$color->name}}</option>
                                                            @endforeach
                                                    </select>
                                                <div class="invalid-feedback">Example invalid custom select feedback</div>
                                            </div>
                                        </div>
                                    </div>


                                        <div class="row">
                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label for="">Font *</label>
                                                        <select class="select2 form-control custom-select" name="monogram_font_types_id" id="monogram_font_types_id" style="width: 100%; height:36px;" required="">
                                                        @foreach($monogram_font_types as $font)
                                                            <option @if($font->id == $monogram->monogram_font_types_id) selected="true" @endif  value="{{$font->id}}">{{$font->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label for="">Location *</label>
                                                    <div class="controls">
                                                        <select class="select2 form-control custom-select" name="monogram_location_types_id" id="monogram_location_types_id" style="width: 100%; height:36px;" required="">
                                                        @foreach($monogram_location_types as $loc)
                                                            <option @if($loc->id == $monogram->monogram_location_types_id) selected="true" @endif  value="{{$loc->id}}">{{$loc->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">Example invalid custom select feedback</div>                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
<!--                                         <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Font *</label>
                                                    <div class="controls">
                                                        <select class=" form-control custom-select" name="monogram_font_types_id" id="monogram_font_types_id">
                                                        @foreach($monogram_font_types as $font)
                                                            <option @if($font->id == $monogram->monogram_font_types_id) selected="true" @endif  value="{{$font->id}}">{{$font->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Location *</label>
                                                    <div class="controls">
                                                        <select class=" form-control custom-select" name="monogram_location_types_id" id="monogram_location_types_id">
                                                        @foreach($monogram_location_types as $loc)
                                                            <option @if($loc->id == $monogram->monogram_location_types_id) selected="true" @endif  value="{{$loc->id}}">{{$loc->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Color *</label>
                                                    <div class="controls">
                                                        <select class=" form-control custom-select" name="colors_id" id="colors_id">
                                                        @foreach($colors as $color)
                                                            <option @if($color->id == $monogram->attributes_id) selected="true" @endif  value="{{$color->id}}">{{$color->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->

                                        <h5 class="card-title mt-5">Monogram  Description</h5>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea value="{{$monogram->description}}" id="description" name="description" class="form-control" rows="4">{{$monogram->description}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Image</label>
                                                    <input name="image" type="file" class="form-control-file" id="exampleInputFile">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <input type="hidden" name="current_image" value="{{ $monogram->image }}">
                                                    @if(!empty( $monogram->image ))
                                                    <img style="width:40px;" src="{{ asset('images/backend-images/liburtiimages/attributes/tiny/'.$monogram->image) }}"> 
                                                    
                                                    <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{ $monogram->id }}" param-route="delete-monogram-image" href="javascript:">Remove</a></button>


                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>
                                                    @if($monogram->is_active == '1')
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  checked="checked" value="1" name="is_active" type="radio" id="customRadioInline1"
                                                        name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input  name="is_active" value="0" type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                                    </div>
                                                    @else
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input value="1" name="is_active" type="radio" id="customRadioInline1"
                                                        name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input checked="checked" value="0" name="is_active" type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                            <!--/span-->
                                        <!-- </div> -->
                                        <hr> </div>
                                    <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <a href="{{ url('/admin/view-monograms')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
