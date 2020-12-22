@extends('layouts.transportLayout.transport-design')
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
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Today's Delivered Orders</h5>
                                <div class="text-right">
                                    <span class="text-muted">Today's Delivered Orders</span>
                                    <h2 class="mt-2 display-7"><sup><i class="ti-arrow-up text-success"></i></sup>${{number_format($today_sales)}}</h2>
                                </div>
                                <!-- <span class="text-success">20%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Total Delivered Orders</h5>
                                <div class="text-right">
                                    <span class="text-muted">Total Delivered Orders</span>
                                    <h2 class="mt-2 display-7"><sup><i class="ti-arrow-down text-danger"></i></sup>${{number_format($today_purchase)}}</h2>
                                </div>
                                <!-- <span class="text-success">30%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Monthly Sales</h5>
                                <div class="text-right">
                                    <span class="text-muted">Monthly Income</span>
                                    <h2 class="mt-2 display-7"><sup><i class="ti-arrow-up text-info"></i></sup>$10,000</h2>
                                </div>
                                <span class="text-info">60%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 60%" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-uppercase">Yearly Sales</h5>
                                <div class="text-right">
                                    <span class="text-muted">Yearly Income</span>
                                    <h2 class="mt-2 display-7"><sup><i class="ti-arrow-up text-inverse"></i></sup>$9,000</h2>
                                </div>
                                <span class="text-inverse">20%</span>
                                <div class="progress">
                                    <div class="progress-bar bg-inverse" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
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