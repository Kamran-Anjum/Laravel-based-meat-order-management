@extends('layouts.productionLayout.production-design')
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
                        <h5 class="font-medium text-uppercase mb-0">Dashboard</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
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
                <!-- First Cards Row  -->
                <!-- ============================================================== -->
                <!--<div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Today's Sales</h5>
                                <div class="text-right">
                                    <span class="text-muted">Today's Sales</span>
                                    <h2 class="mt-2 display-7"><sup><i class="ti-arrow-up text-success"></i></sup>Kr.{{number_format($today_sales)}}</h2>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Today's Purchases</h5>
                                <div class="text-right">
                                    <span class="text-muted">Today's Purchases</span>
                                    <h2 class="mt-2 display-7"><sup><i class="ti-arrow-down text-danger"></i></sup>Kr.{{number_format($today_purchase)}}</h2>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    
                </div>-->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                    <div class="form-body">
                                        <h5 class="card-title">Get Summary From Selected Dates</h5>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">From Date</label>
                                                    <input type="date" id="fdate" class="form-control">                                                   
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">                                                  
                                                    <label  for="">From Date</label>
                                                    <input type="date" id="tdate" class="form-control">                                                   
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-0">
                                                <div class="form-group">
                                                    <label  for=""></label>
                                                    <input onclick="getSummary()" style="display: block; top: 9px;" type="button" class="btn btn-danger" value="Search">                                                   
                                                    <div class="invalid-feedback">Example invalid custom select feedback</div>
                                                </div>
                                            </div>

                                        </div>
                                                                  
                                    </div>
                                           

                                    </div>
                            </div>
                        </div>
                    </div>

                    <div class="row" id="sortedSummary"></div>
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
<!--             <footer class="footer text-center">
                All Rights Reserved by Ample admin. Designed and Developed by
                <a href="https://wrappixel.com">WrapPixel</a>.
            </footer> -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
@endsection