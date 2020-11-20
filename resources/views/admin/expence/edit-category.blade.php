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
                        <h5 class="font-medium text-uppercase mb-0">Edit Category</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
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
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                @foreach($categories as $category)
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-category/'.$category->id) }}" name="edit_category" id="edit_category"> {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">About Category</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code</label>
                                                    <input value="{{$category->code}}" type="text" id="code" name="code" class="form-control" placeholder="" required=""></div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input value="{{$category->name}}" id="name" name="name" type="text" id="lastName" class="form-control" placeholder="" required> </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code Attachment</label>
                                                    <input value="{{$category->code_attachment}}" type="text" id="code_attachment" name="code_attachment" class="form-control" placeholder="" required=""></div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <!--/row-->
                                        <!--/row-->
                                            <!--/span-->
                                            <!--/span-->
                                        <!-- </div> -->
                                        <h5 class="card-title mt-5">Category Description</h5>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea value="{{$category->description}}" id="description" name="description" class="form-control" rows="4">{{$category->description}}</textarea>
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
                                                    <input type="hidden" name="current_image" value="{{ $category->image }}">
                                                    @if(!empty( $category->image ))
                                                    <img style="width:40px;" src="{{ asset('images/backend-images/liburtiimages/attributes/tiny/'.$category->image) }}"> 
                                                    
                                                    <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{ $category->id }}" param-route="delete-category-image" href="javascript:">Remove</a></button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Category Attributes -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Fit Size Types</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-fittypes" name="mts-fittypes[]" style="width: 100%;height: 36px;">
                                                            {!! $fittypes_dropdown !!}
                                                        </select>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Colors</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-colors" name="mts-colors[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $colors_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Sizes</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-sizes" name="mts-sizes[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $sizes_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Pockets
                                                    </h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-pockets" name="mts-pockets[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $pockets_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Plackets</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-plackets" name="mts-plackets[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $plackets_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Styles
                                                    </h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-styles" name="mts-styles[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $styles_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Buttons</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-buttons" name="mts-buttons[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $buttons_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Collars
                                                    </h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-collars" name="mts-collars[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $collars_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Cuffs</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-cuffs" name="mts-cuffs[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $cuffs_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Fits
                                                    </h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-fits" name="mts-fits[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $fits_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Collections</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-collections" name="mts-collections[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $collections_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Designs
                                                    </h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-designs" name="mts-designs[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $designs_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Lapels</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-lapels" name="mts-lapels[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $lapels_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Seasons
                                                    </h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-seasons" name="mts-seasons[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $seasons_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Constructions</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-constructions" name="mts-constructions[]" style="width: 100%;height: 36px;">
                                                            <option>{!! $constructions_dropdown !!}</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h4 class="card-title">Monograms
                                                </h4>
                                                <div class="form-group">
                                                    <select multiple class="form-control" id="mts-monograms" name="mts-monograms[]" style="width: 100%;height: 36px;">
                                                        <option>{!! $monograms_dropdown !!}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                                

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>
                                                    @if($category->is_active == '1')
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
                                        <a href="{{ url('/admin/view-categories')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
