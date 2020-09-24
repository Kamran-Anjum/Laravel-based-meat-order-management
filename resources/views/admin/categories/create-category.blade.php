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
                        <h5 class="font-medium text-uppercase mb-0">Add Category</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Category</li>
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
                        <div class="card">
                            <div class="card-body">
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/create-category') }}" name="add_category" id="add_category"> {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">About Category</h5>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code</label>
                                                    <input required type="text" id="code" name="code" class="form-control" placeholder=""></div>
                                            </div>
                                            <!--/span-->
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                    <input required type="text" id="name" name="name" class="form-control" placeholder=""> </div>
                                            </div>
                                            <!--/span-->
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Code Attachment</label>
                                                    <input required type="text" id="code_attachment" name="code_attachment" class="form-control" placeholder=""></div>
                                            </div>
                                        </div>
                                        <!--/row-->
                                        <h5 class="card-title mt-5"> Description</h5>
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <div class="form-group">
                                                    <textarea class="form-control" name="description" rows="4"></textarea>
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
                                                            {!! $colors_dropdown !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Sizes</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-sizes" name="mts-sizes[]" style="width: 100%;height: 36px;">
                                                            {!! $sizes_dropdown !!}
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
                                                            {!! $pockets_dropdown !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Plackets</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-plackets" name="mts-plackets[]" style="width: 100%;height: 36px;">
                                                            {!! $plackets_dropdown !!}
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
                                                            {!! $styles_dropdown !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Buttons</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-buttons" name="mts-buttons[]" style="width: 100%;height: 36px;">
                                                            {!! $buttons_dropdown !!}
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
                                                            {!! $collars_dropdown !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Cuffs</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-cuffs" name="mts-cuffs[]" style="width: 100%;height: 36px;">
                                                            {!! $cuffs_dropdown !!}
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
                                                            {!! $fits_dropdown !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Collections</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-collections" name="mts-collections[]" style="width: 100%;height: 36px;">
                                                            {!! $collections_dropdown !!}
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
                                                            {!! $designs_dropdown !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Lapels</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-lapels" name="mts-lapels[]" style="width: 100%;height: 36px;">
                                                            {!! $lapels_dropdown !!}
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
                                                            {!! $seasons_dropdown !!}
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class="col-md-6">
                                                    <h4 class="card-title">Constructions</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-constructions" name="mts-constructions[]" style="width: 100%;height: 36px;">
                                                            {!! $constructions_dropdown !!}
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
                                                        {!! $monograms_dropdown !!}
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="1" id="customRadioInline1" checked="checked" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline1">Active</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="0" id="customRadioInline2" name="is_active" class="custom-control-input">
                                                        <label class="custom-control-label" for="customRadioInline2">Inactive</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
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
