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
                    <div class="col-lg-4 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0">Edit {{$fittypes->name}} Size Attributes</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit {{$fittypes->name}} Size Attributes</li>
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
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-fitsize/'.$sizeattributes->id) }}" name="edit_fitsize" id="edit_fitsize"> {{ csrf_field() }}
                                <h4 class="card-title">Edit size attributes</h4>
                                    <form class="needs-validation" novalidate>
                                        <div class="row">
                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label for="">Collar Size</label>
                                                    <select id="collarsize" name="collarsize" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                    {!! $collarsizes_dropdown !!}
                                                    </select>
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label for="">Sleeve Size</label>
                                                    <select id="sleevesize" name="sleevesize" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                    {!! $sleevesizes_dropdown !!}
                                                    </select>
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Shoulder</label>
                                                    <input name="shoulder" type="text" class="form-control" id="shoulder" placeholder="" value="{{$sizeattributes->shoulder}}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Shoulder Xml</label>
                                                    <input name="shoulder_xml" type="text" class="form-control" id="shoulder_xml" placeholder="" value="{{$sizeattributes->shoulder_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Sleeve Width</label>
                                                    <input name="sleeve_width" type="text" class="form-control" id="sleeve_width" placeholder="" value="{{$sizeattributes->sleeve_width }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                </div>
                                                    </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Sleeve Width Xml</label>
                                                    <input name="sleeve_width_xml" type="text" class="form-control" id="sleeve_width_xml" placeholder="" value="{{$sizeattributes->sleeve_width_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                    
                                            <!-- <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">West</label>
                                                    <input name="west" type="text" class="form-control" id="west" placeholder="" value="{{$sizeattributes->west }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">West Xml</label>
                                                    <input name="west_xml" type="text" class="form-control" id="west_xml" placeholder="" value="{{$sizeattributes->west_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div> -->
                                        </div>
                                        <div class="row">
                                            <!-- <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Sleeve Length Range</label>
                                                    <input name="sleeve_length_range" type="text" class="form-control" id="sleeve_length_range" placeholder="" value="{{$sizeattributes->sleeve_length_range }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Sleeve Length Range Xml</label>
                                                    <input name="sleeve_length_range_xml" type="text" class="form-control" id="sleeve_length_range_xml" placeholder="" value="{{$sizeattributes->sleeve_length_range_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div> -->
                                            
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Cuff</label>
                                                    <input name="cuff" type="text" class="form-control" id="cuff" placeholder="" value="{{$sizeattributes->cuff }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Cuff Xml</label>
                                                    <input name="cuff_xml" type="text" class="form-control" id="cuff_xml" placeholder="" value="{{$sizeattributes->cuff_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Midsection</label>
                                                    <input name="midsection" type="text" class="form-control" id="midsection" placeholder="" value="{{$sizeattributes->midsection }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Midsection Xml</label>
                                                    <input name="midsection_xml" type="text" class="form-control" id="midsection_xml" placeholder="" value="{{$sizeattributes->midsection_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "row">
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Hip</label>
                                                    <input name="hip" type="text" class="form-control" id="hip" placeholder="" value="{{$sizeattributes->hip }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Hip Xml</label>
                                                    <input name="hip_xml" type="text" class="form-control" id="hip_xml" placeholder="" value="{{$sizeattributes->hip_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Chest</label>
                                                    <input name="chest" type="text" class="form-control" id="chest" placeholder="" value="{{$sizeattributes->chest}}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-0">
                                                <div class="form-group">
                                                    <label for="">Chest Xml</label>
                                                    <input name="chest_xml" type="text" class="form-control" id="chest_xml" placeholder="" value="{{$sizeattributes->chest_xml }}" required>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label for="">Shirt Length</label>
                                                    <input name="shirt_length" type="text" class="form-control" id="shirt_length" placeholder="" value="{{$shirtlength}}" readonly>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class = "row">
                                            <div class="col-md-6 mb-0">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>
                                                    @if($sizeattributes->is_active == '1')
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
                                        </div>
                                
                                        <hr>
                                        
                                        <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                        <button type="" class="btn btn-dark"><a class="text-white" href="{{ url('/admin/view-fits/'.$fittypes->id)}}"><i class="fa fa-times"></i> Cancel</a></button>
                            
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
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
      <!--   </div> -->
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

@endsection
