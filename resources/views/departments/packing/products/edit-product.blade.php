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
                        <h5 class="font-medium text-uppercase mb-0">Edit Product</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                .hidden{
                    display: none;
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
                            <form enctype="multipart/form-data" method="post" action="{{ url('/admin/edit-product/'.$product->id) }}" name="edit_product" id="edit_product"> {{ csrf_field() }}
                            <h4 class="card-title">Add new Product</h4>
                            <form class="needs-validation" novalidate>
                                <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Product Type</label>
                                            <select id="producttype" name="product_type" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                <option selected disabled>Select Product Type</option>
                                                @if($product->product_type == 3)
                                                <option value="1">Type I</option>
                                                <option value="2">Type II</option>
                                                <option selected value="3">Type III</option>
                                                @elseif($product->product_type == 2)
                                                <option value="1">Type I</option>
                                                <option selected value="2">Type II</option>
                                                <option value="3">Type III</option>
                                                @else
                                                <option selected="" value="1">Type I</option>
                                                <option value="2">Type II</option>
                                                <option value="3">Type III</option>
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Inventory Type</label>
                                            <select product-id="{{ $product->id }}" id="edit-inventorytype" name="inventorytype" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                <option>{!! $inventorytypes_dropdown !!}</option>
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Fabric</label>
                                            <select name="fabrictype" id="fabricdd" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                <option>{!! $fabrics_dropdown !!}</option>
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for=""> Category</label>
                                            <select name="categorytypeedit" id="productcategoryddedit" class="select2 form-control custom-select" style="width: 100%; height:36px;" required>
                                                <option>{!! $categories_dropdown !!}</option>
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for=""> Sub-Category</label>
                                            <select name="subcategorytypeedit[]" id="productsubcategory"class="form-control" multiple="" style="width: 100%; height:36px;" required>
                                                <option>{!! $subcategories_dropdown !!}</option>
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                </div>
                                <div class = "row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label name="name" for="product-name">Name</label>
                                            <input name="name" type="text" class="form-control" id="product-name" placeholder="" value="{{$product->name}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="product-code">Code</label>
                                            <input name="code" type="text" class="form-control" id="product-code" placeholder="" value="{{$product->code}}" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Fit Types</label>
                                            <select name="mts-fittypes[]" class="form-control" multiple="" id="product-assign-fittypes" style="width: 100%;height: 36px;">
                                                @if($product->product_type == 3)
                                                {!! $fittypes_dropdown !!}
                                                @else
                                                {!! $fittypedrp_dwn !!}
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Colors</label>
                                            <select name="mts-colors[]" class="form-control" multiple="" id="product-assign-colors" style="width: 100%;height: 36px;">
                                                {!! $colors_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
 
                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="">Sizes</label>
                                            <select name="mts-sizes[]" class="form-control" multiple="" id="product-assign-sizes" style="width: 100%;height: 36px;">
                                                @if($product->product_type == 3)
                                                {!! $sizes_dropdown !!}
                                                @elseif($product->product_type == 2)
                                                {!! $fitcollardrp_dwn !!}
                                                @else
                                                {!! $fitcollardrp_dwn !!}
                                                @endif
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    @if($product->product_type != 2)
                                    <div class="col-md-3 mb-0">
                                        <div class="form-group hidden" id="slvesize">
                                            <label for="">Sleeve Sizes</label>
                                            <select name="mts-ssizes[]" class="form-control" multiple="" id="product-assign-slsizes" style="width: 100%;height: 36px;">
                                               
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-md-3 mb-0">
                                        <div class="form-group" id="slvesize">
                                            <label for="">Sleeve Sizes</label>
                                            <select name="mts-ssizes[]" class="form-control" multiple="" id="product-assign-slsizes" style="width: 100%;height: 36px;">
                                                {!! $fitsleevedrp_dwn !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Pockets</label>
                                            <select name="mts-pockets[]" class="form-control" multiple="" id="product-assign-pockets" style="width: 100%;height: 36px;">
                                                {!! $pockets_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Plackets</label>
                                            <select name="mts-plackets[]" class="form-control" multiple="" id="product-assign-plackets" style="width: 100%;height: 36px;">
                                                {!! $plackets_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Styles</label>
                                            <select name="mts-styles[]" class="form-control" multiple="" id="product-assign-styles" style="width: 100%;height: 36px;">
                                                {!! $styles_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Buttons</label>
                                            <select name="mts-buttons[]" class="form-control" multiple="" id="product-assign-buttons" style="width: 100%;height: 36px;">
                                                {!! $buttons_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Collars</label>
                                            <select name="mts-collars[]" class="form-control" multiple="" id="product-assign-collars" style="width: 100%;height: 36px;">
                                                {!! $collars_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Cuffs</label>
                                            <select name="mts-cuffs[]" class="form-control" multiple="" id="product-assign-cuffs" style="width: 100%;height: 36px;">
                                                {!! $cuffs_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Fits</label>
                                            <select name="mts-fits[]" class="form-control" multiple="" id="product-assign-fits" style="width: 100%;height: 36px;">
                                                {!! $fits_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Collections</label>
                                            <select name="mts-collections[]" class="form-control" multiple="" id="product-assign-collections" style="width: 100%;height: 36px;">
                                                {!! $collections_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Designs</label>
                                            <select name="mts-designs[]" class="form-control" multiple="" id="product-assign-designs" style="width: 100%;height: 36px;">
                                                {!! $designs_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Lapels</label>
                                            <select name="mts-lapels[]" class="form-control" multiple="" id="product-assign-lapels" style="width: 100%;height: 36px;">
                                                {!! $lapels_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Seasons</label>
                                            <select name="mts-seasons[]" class="form-control" multiple="" id="product-assign-seasons" style="width: 100%;height: 36px;">
                                                {!! $seasons_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Constructions</label>
                                            <select name="mts-constructions[]" class="form-control" multiple="" id="product-assign-constructions" style="width: 100%;height: 36px;">
                                                {!! $constructions_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Monograms</label>
                                            <select name="mts-monograms[]" class="form-control" multiple="" id="product-assign-monograms" style="width: 100%;height: 36px;">
                                                {!! $monograms_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Related Products</label>
                                            <select name="mts-relatedproducts[]" class="form-control" multiple="" id="product-assign-relatedproduct" style="width: 100%;height: 36px;">
                                                {!! $relatedproducts_dropdown !!}
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class = "row">
                                    <div class="col-md-12 mb-0">
                                        <div class="form-group">
                                            <label for="product-description">Description</label>
                                            <textarea name="description" type="text" class="form-control" id="product-description" placeholder="" value="custom" rows= "2" readonly>{{$fabricdetail->description}}
                                            </textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class = "row">
                                    <div class="col-md-12 mb-0">
                                        <div class="form-group">
                                            <label for="product-composition">Composition</label>
                                            <input name="product-composition" type="text" class="form-control" id="product-composition" placeholder="" value="{{$fabricdetail->composition}}" readonly>

                                        </div>
                                    </div>
                                </div>

                                <div class = "row">
                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="product-fabric-id">Fabric ID</label>
                                            <input name="product-fabric-id" type="text" class="form-control" id="product-fabric-id" placeholder="" value="{{$fabricdetail->fabric_id}}" readonly>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="product-fabric-thickness">Thickness</label>
                                            <input type="text" class="form-control" name="product-fabric-thickness" id="product-fabric-thickness" placeholder="" value="{{$fabricdetail->thickness}}" readonly>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="product-style">Style</label>
                                            <input type="text" class="form-control" name="product-style" id="product-style" placeholder="" value="{{$fabricdetail->stylename}}" readonly>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="product-style">Color</label>
                                            <input type="text" class="form-control" name="product-color" id="product-color" placeholder="" value="{{$fabricdetail->colorname}}" readonly>

                                        </div>
                                    </div>
                                </div>

                                <hr>

                                <div class = "row">
                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="button-color">Default Button Color</label>
                                            <select name="defualt-button-colordd" id="defualt-button-colordd" class="select2 form-control custom-select" style="width: 100%; height:36px;" >
                                                {!! $button_colors_dropdown !!}
                                            </select>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="product-price">Price</label>
                                            <input type="number" class="form-control" name="product-price" id="product-price" placeholder="" value="{{$product->price}}" required>

                                        </div>
                                    </div>

                                    <div class="col-md-3 mb-0">
                                        <div id="edit-quantity" class="form-group">
                                            @if($product->inventorytypes_id == '1')
                                            <label for="product-qty">Qty</label>
                                            <input name="product-qty" type="number" class="form-control" id="product-qty" placeholder="" value="{{$product->quantity}}" required>
                                            @endif

                                        </div>
                                    </div>

<!--                                     <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="product-sale-price">Sales Price</label>
                                            <input type="number" class="form-control" name="product-sale-price" id="product-sale-price" placeholder="" value="{{$product->saleprice}}" required>

                                        </div>
                                    </div> -->
                                </div>

                                <div class = "row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <h5 for="product-thickness">Featured Image</h5>
                                                <fieldset class="form-group">
                                                    <input name="featured_image" type="file" class="form-control-file"  id="exampleInputFile">
                                                </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id={{$product->id}} param-route="delete-image" href="javascript:">Remove</a></button>
{{--                                            <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-deletes" param-id="{{$product->id}}" param-route="delete-color-image" href="javascript:">Remove</a></button>--}}
                                            <input name="galleryimage" type="hidden" name="" value="">
                                            <input type="hidden" name="current_image" value="{{ $product->image }}">
                                            @if(!empty( $product->image ))
                                                <img src="{{ asset('/images/backend-images/liburtiimages/products/tiny/'.$product->image ) }}" width="80">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <h5 for="product-thickness">Gallery Images</h5>
                                                <fieldset class="form-group">
                                                    <input type="file" class="form-control-file btn-file"  name="gallery_images[]" id="exampleInputFile" multiple data-show-upload="true" data-show-caption="true">
                                                </fieldset>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
{{--                                            <button type="button" class="btn waves-effect waves-light btn-danger sa-confirm-delete"><a class="text-white" param-id="" param-route="delete-color-image" href="javascript:">Remove</a></button>--}}
                                            <input type="hidden" name="" value="">
                                            @foreach($galleryimages as $galleryimage)
                                                <img src="{{ asset('/images/backend-images/liburtiimages/gallery-products/tiny/'.$galleryimage->image ) }}" width="80">
                                                <!-- <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id={{$galleryimage->id}} param-route="delete-gallery-image" href="javascript:">Remove</a></button> -->
                                                <button type="button" class="close btn-close" aria-label="Close" style="position: absolute;background: #ff5050;color: white;top: -6px;border-radius: 40px;padding: 3px 5px; margin-left:-18px; font-size:small; opacity:1;">
                                                    <a class="text-white sa-confirm-delete" param-id={{$galleryimage->id}} param-route="delete-gallery-image" href="javascript:"><span aria-hidden="true" style="font-weight:100;">&times;</span></a>
                                                </button> 
                                            @endforeach          
                                        </div>
                                    </div>
                                </div>


                                <div class = "row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <br/>
                                                    @if($product->is_active == '1')
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

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                                <div class="form-group">
                                                    <label>Customizable</label>
                                                    <br/>
                                                    @if($product->is_customize == '1')
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="1" id="is_customizable1" checked="checked" name="is_customizable" class="custom-control-input">
                                                        <label class="custom-control-label" for="is_customizable1">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="0" id="is_customizable2" name="is_customizable" class="custom-control-input">
                                                        <label class="custom-control-label" for="is_customizable2">No</label>
                                                    </div>
                                                    @else
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="1" id="is_customizable1" name="is_customizable" class="custom-control-input">
                                                        <label class="custom-control-label" for="is_customizable1">Yes</label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input type="radio" value="0" id="is_customizable2" checked="checked" name="is_customizable" class="custom-control-input">
                                                        <label class="custom-control-label" for="is_customizable2">No</label>
                                                    </div>
                                                    @endif
                                                </div>


                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="form-actions mt-5">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                <button type="" class="btn btn-dark"><a class="text-white" href="{{ url('/admin/list-product')}}"><i class="fa fa-times"></i> Cancel</a></button>

                            </div>
                            </div>
                            </form>
                        </div>




                            <script>
                            // Example starter JavaScript for disabling form submissions if there are invalid fields
                            (function() {
                                'use strict';
                                window.addEventListener('load', function() {
                                    // Fetch all the forms we want to apply custom Bootstrap validation styles to
                                    var forms = document.getElementsByClassName('needs-validation');
                                    // Loop over them and prevent submission
                                    var validation = Array.prototype.filter.call(forms, function(form) {
                                        form.addEventListener('submit', function(event) {
                                            if (form.checkValidity() === false) {
                                                event.preventDefault();
                                                event.stopPropagation();
                                            }
                                            form.classList.add('was-validated');
                                        }, false);
                                    });
                                }, false);
                            })();
                            </script>
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
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

@endsection
