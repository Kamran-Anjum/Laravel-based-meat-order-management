@extends('layouts.adminLayout.admin-design')
@section('content')
<style type="text/css">
    .stl{
        margin-left: 15px;
        margin-bottom: 15px;
    }
</style>
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
                        <h5 class="font-medium text-uppercase mb-0">Assign Promotion To Prodcts</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Assign Promotion</li>
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


                                <div class="row">
                                            <div class="col-md-6 stl">
                                                    <h4 class="card-title">Select Category</h4>
                                                    <div class="form-group">
                                                        <select class="form-control" id="mts-cattypes" name="category_ids" style="width: 100%;height: 36px;">
                                                            <option>select Category</option>
                                                            {!! $category_dropdown !!}
                                                        </select>
                                                    </div>
                                            </div>
                                            
                                        </div>
 
                                <div class="row">
                                            <div class="col-md-6 stl">
                                                    <h4 class="card-title">Select Sub-Category</h4>
                                                    <div class="form-group">
                                                        <select multiple class="form-control" id="mts-scattypes" name="subcategory_ids[]" style="width: 100%;height: 36px;">

                                                          
                                                        </select>
                                                            
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 stl">
                                                
                                                <div id="btnall" class="form-group">
                                                        <button id="btna" type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/assign-productall/') }}">Assign To All Products</a></button>
                                                         <button id="btna" type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/unassign-productall/') }}">Un-Assign from All Products</a></button>
                                                            
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
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="material-card card">
                            <div class="card-body">

                                <div class="table-responsive">

                                    <table id="zero_config" class="table table-striped border">
                                        
                                        <thead>
                                            <tr>
                                                <th>Prduct Name</th>                                  
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Price</th>
                                                <th>sale Price</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Actio</th>
                                                <th>Update To This</th>

                                                
                                                
                                            </tr>
                                        </thead>

                                        <tbody id="ajax-data">
                                        @foreach($productDetails as $product)
                                            <tr>
                                                <td>{{$product->name}}</td>
                                                <td>{{$product->catName}}</td>
                                                <td>{{$product->subcatName}}</td>
                                                <td>{{$product->price}}</td>
                                                <td>{{$product->saleprice}}</td>
                                                <td>{{$product->image}}</td>
                                                <td> 
                                                    @if($product->promotoin_id == 0) 
                                                        Not Assinged
                                                    @else
                                                        Assinged
                                                    @endif
                                                </td>
                                                <td>
                                                @php
                                                    $val = session('promotionids');
                                                @endphp
                                                    <div class="button-group">
                                                    @if($product->promotoin_id == 0) 
                                                        <button type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/assign-product/'.$product->id) }}">Assign To Products</a></button>
                                                    @elseif($product->promotoin_id == $val)
                                                        <button type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/unassign-product/'.$product->id) }}">Un-Assign</a></button>
                                                    @else
                                                        <button type="button" disabled class="btn waves-effect waves-light btn-success"><a class="text-white" >Un-Assign</a></button>
                                                    @endif
                                                	
                                                        
													</div>
												</td>
                                                
                                                <td>
                                                    <div class="button-group">
                                                    @if($product->promotoin_id == $val) 
                                                        <button type="button" disabled class="btn waves-effect waves-light btn-success">Already To this Promo</button>
                                                    @elseif($product->promotoin_id == 0)
                                                    <button type="button" disabled class="btn waves-effect waves-light btn-success">You Can Assign</button>
                                                    @else
                                                        <button type="button" class="btn waves-effect waves-light btn-success"><a class="text-white" href="{{ url('admin/assign-product/'.$product->id) }}">Update to this Promo</a></button>
                                                    @endif
                                                    
                                                        
                                                    </div>
                                                </td>

                                            </tr>
                                        @endforeach

                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Prduct Name</th>                                  
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Price</th>
                                                <th>sale Price</th>
                                                <th>Image</th>
                                                <th>Status</th>
                                                <th>Actio</th>
                                                <th>Update To This</th>
                                            </tr>
                                        </tfoot>
                                    </table>
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
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->

@endsection
