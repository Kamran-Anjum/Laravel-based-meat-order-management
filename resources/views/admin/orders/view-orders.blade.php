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
                        <h5 class="font-medium text-uppercase mb-0">View Product</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">View Products</li>
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
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                        <div class="material-card card">
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                            <table class="table">
                                                <tbody>
                                                    <tr>
                                                        <th width="390">Featured Image</th>
                                                        <td>
                                                            <div class="col-lg-2 col-md-3 col-sm-6">
                                                                <div class="white-box text-center"> <img src="{{ asset('/images/backend-images/gallery/chair.jpg' ) }}" class="img-responsive" width="200"> 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Gallery Images</th>
                                                        <td>
                                                            <div class="col-lg-6 col-md-3 col-sm-6">
                                        
                                                                <div class="gallery"> 

                                                                    <img src="{{ asset('/images/backend-images/gallery/chair2.jpg' ) }}" width = "80" class="img-responsive"> 
                                                                    <img src="{{ asset('/images/backend-images/gallery/chair3.jpg' ) }}" width = "80" class="img-responsive">
                                                                    <img src="{{ asset('/images/backend-images/gallery/chair4.jpg' ) }}" width = "80" class="img-responsive">
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Inventory Type</th>
                                                        <td>In Stock </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product name</th>
                                                        <td>Elegant Shirt </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product code</th>
                                                        <td>0001</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product category</th>
                                                        <td>Formal </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product sub-category</th>
                                                        <td>Semi</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Product fabric</th>
                                                        <td>Cotton</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Button style</th>
                                                        <td>Fancy</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Cuff style</th>
                                                        <td>cuffs</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Collar style</th>
                                                        <td>texido</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Placket style</th>
                                                        <td>doube</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Pocket style</th>
                                                        <td>pocket</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Monogram</th>
                                                        <td>mono</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Description</th>
                                                        <td>Description</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Composition</th>
                                                        <td>composition</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fabric ID</th>
                                                        <td>A31</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Thickness</th>
                                                        <td>thick</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Style</th>
                                                        <td>style</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Color</th>
                                                        <td>color</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Default button color</th>
                                                        <td>Blue</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Quantity</th>
                                                        <td>6</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Price</th>
                                                        <td>$14</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sale Price</th>
                                                        <td>$11</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>Published</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Customizable</th>
                                                        <td>NOoo</td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-actions mt-3">
                                            <button type="" class="btn btn-success"><a class="text-white" href="{{ url('/admin/list-product')}}"><i class="fa fa-arrow-left"></i> Back</a></button>
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
