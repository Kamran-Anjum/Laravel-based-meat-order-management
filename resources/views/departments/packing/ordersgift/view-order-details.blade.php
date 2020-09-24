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
                                                    @foreach($gitorderdetails as $gitorderdetail)
                                                    <tr>
                                                        <th width="390">Image</th>
                                                        <td>
                                                            <div class="col-lg-2 col-md-3 col-sm-6">
                                                                <div class="white-box text-center"> <img src="{{ asset('/images/backend-images/liburtiimages/products/tiny/'.$gitorderdetail->image ) }}" class="img-responsive" width="200"> 
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <th>Order number</th>
                                                        <td>{{$gitorderdetail->giftorder_id}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>User Account</th>
                                                        @if(!empty($useremail))
                                                        <td><strong>Username:</strong> {{$usermane}} || <strong>User Email:</strong> {{$useremail}}</td>
                                                        @else
                                                        <td>{{$usermane}}</td>
                                                        @endif
                                                        
                                                        
                                                    </tr>
                                                    <tr>
                                                        <th>Reciever Name</th>
                                                        <td>{{$gitorderdetail->reciever_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sender Name</th>
                                                        <td>{{$gitorderdetail->sender_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Gift Type</th>
                                                        @if($gitorderdetail->ship_type == 'Shipping')
                                                        <td>Gift Card</td>
                                                        @else
                                                        <td>E-Gift Card</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <th>Sender Contact</th>
                                                        <td>{{$gitorderdetail->phone_no}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Sender Email</th>
                                                        <td>{{$gitorderdetail->gift_from_email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Reciever Email</th>
                                                        <td>{{$gitorderdetail->gift_to_email}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Shipping Address</th>
                                                        <td>{{$gitorderdetail->shipping_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Billing Address</th>
                                                        <td>{{$gitorderdetail->billing_address}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Price</th>
                                                        <td>{{$gitorderdetail->price}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Quantity</th>
                                                        <td>{{$gitorderdetail->quantity}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Amount</th>
                                                        <td>{{$gitorderdetail->total_price}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Status</th>
                                                        <td>{{$gitorderdetail->status}}</td>
                                                    </tr>
                                                    
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="form-actions mt-3">
                                            <button type="" class="btn btn-success"><a class="text-white" href="{{ url('/admin/view-gift-orders')}}"><i class="fa fa-arrow-left"></i> Back</a></button>
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
