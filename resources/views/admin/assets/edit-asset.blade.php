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
                        <h5 class="font-medium text-uppercase mb-0">Edit Product</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                                <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-product/'.$products->id) }}" > {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">Edit Product</h5>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Category ID</label>
                                                    <select class="form-control" id="product_category_id" name="product_category_id">
                                                        {!! $categories_dropdown !!}
                                                    </select>                                                    
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Sub Category</label>
                                                    <select name="subcategory[]" id="subcategory" class="form-control select2" multiple="" style="width: 100%; height:36px;" required>
                                                        {!! $subcategories_dropdown !!}
                                            </select>                                                  
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                        </div>
                                      
                                        <div class="row">
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Name</label>
                                                    <input value="{{$products->name}}" type="text" class="form-control" name="product_name">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">SKU Number</label>
                                                    <input value="{{$products->sku_number}}" type="text" class="form-control" name="sku_number">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Base Price</label>
                                                    <input value="{{$products->base_price}}" type="number" class="form-control" name="base_price">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                    
                                                    <label  for="">Description</label>
                                                    <textarea name="description" class="form-control" rows="5" cols="5">{{$products->description}}</textarea>
                                                   
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            
                                        </div>
                                      
                                      <div class="row">
                                              
                                             <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">First Image</label>
                                                    <input type="file" class="form-control" name="image">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{$products->id}}" param-route="delete-supplier-image" href="javascript:">Remove</a></button>
{{--                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-deletes" param-id="{{$products->id}}" param-route="delete-product-image" href="javascript:">Remove</a></button>--}}
                                            <input name="galleryimage" type="hidden" name="" value="">
                                            <input type="hidden" name="current_image" value="{{ $products->image }}">
                                            @if(!empty( $products->image ))
                                                <img src="{{ asset('images/backend-images/halalmeat/products/tiny/'.$products->image ) }}" width="80">
                                            @endif
                                        </div>
                                    </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">Gallery Image</label>
                                                    <input type="file" class="form-control" multiple name="gallery_images[]">
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                        <div class="form-group">
{{--                                            <button type="button" class="btn waves-effect waves-light btn-danger sa-confirm-delete"><a class="text-white" param-id="" param-route="delete-product-gallery-image" href="javascript:">Remove</a></button>--}}
                                            <input type="hidden" name="" value="">
                                            @foreach($product_details as $galleryimage)
                                                <img src="{{ asset('/images/backend-images/halalmeat/gallery-products/tiny/'.$galleryimage->gallery_image ) }}" width="80">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id={{$galleryimage->id}} param-route="delete-gallery-image" href="javascript:">Remove</a></button> -->
                                                <button type="button" class="close btn-close" aria-label="Close" style="position: absolute;background: #ff5050;color: white;top: -6px;border-radius: 40px;padding: 3px 5px; margin-left:-18px; font-size:small; opacity:1;">
                                                    <a class="text-white sa-confirm-delete" param-id={{$galleryimage->id}} param-route="delete-gallery-image" href="javascript:"><span aria-hidden="true" style="font-weight:100;">&times;</span></a>
                                                </button> 
                                            @endforeach          
                                        </div>
                                    </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>
                                                    @if($products->is_active == "1")
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
                                                                  
                                    </div>

                                        <hr>
                                        <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Edit</button>
                                        <a href="{{ url('/admin/view-products')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
                                    </div>
                                           </form>

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
