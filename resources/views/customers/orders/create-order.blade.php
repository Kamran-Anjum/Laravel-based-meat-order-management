@extends('layouts.customerLayout.customer-design')
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
                        <h5 class="font-medium text-uppercase mb-0">Add Sales Order</h5>
                    </div>
                    <div class="col-lg-9 col-md-8 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Sales Order</li>
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
                    tbody td input{
                        border:none !important;
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
                                <form enctype="multipart/form-data" method="post" action="{{ url('/user/add-order') }}"> {{ csrf_field() }}
                                    <div class="form-body">
                                        <h5 class="card-title">Create Sales Order</h5>
                                        <hr>

                                        <div class="row">
                                           
                                            </div>
                                          	 <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Order Date</label>
                                                    <input name="order_date" type="date" class="form-control" required>
                                                    <input type="hidden" id="user_id" value="{{$user_role->id}}"></ins>
                                                </div>
                                            </div>
                                        </div>
                                       
                                		<h5 class="card-title mt-4">Products Entry</h5>
                       
                                        <div class="row">
                                     
                                         
                                       <div class="table-responsive">
                                    <table  class="table table-striped border">
                                        <thead>
                                            <tr>
                                                <th>Category</th>
                                                <th>Sub-Category</th>
                                                <th>Product</th>                                     
                                                <th>Unit</th>
                                                <th>Stock</th>
                                                <th>Qty</th>
                                                <th>Sale Price</th>
                                                <th>Amount</th>
                                                <th>SubTotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                      
                                            <tr>
                                                <td style="width: 15%">
                                                    <select required id="category_user" class="form-control">
                                                        {!! $categories_dropdown !!}
                                                    </select>  
                                         		</td>

                                         		<td style="width: 15%">
                                                    <select disabled required id="sub_category_user" class="form-control">
                                                    </select> 
                                         		</td>
                                         		<td style="width: 15%">
                                                    <select disabled required id="product_id_user" class="form-control">
                                                    </select> 
                                                 
                                         		</td>
                                         		<td style="width: 5%">
                                                 <input required id="unit" type="text" readonly value="KG" class="form-control" placeholder="">  
                                         		</td>
                                         		<td style="width: 7%">
                                                 <input required readonly id="stocks" type="number" class="form-control" placeholder="">  
                                         		</td>
                                         		<td style="width: 6%">
                                                 <input  id="qty" type="number" class="form-control" placeholder="">  
                                         		</td>
                                         		<td>
                                                 <input required readonly id="sale_price" type="number" class="form-control" placeholder="">  
                                         		</td>
                                         		<td>
                                                 <input required readonly value="0" id="sub_total" type="number" class="form-control" placeholder="">  
                                         		</td>
                                                        
                                              
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button" value="Add row" onclick="getcurrentRow();" class="btn waves-effect waves-light btn-info">Add</button>
                                                     

                                                    </div>
                                                </td>

                                            </tr>
                                           
                                        </tbody>
                                      
                                    </table>
                                </div>
                                <hr>
                                       
                                        </div>
                                        <div class="row">
                                     
                                         
                                       <div class="table-responsive">
                                    <table  class="table table border" id="dataTable2" >
                                        <thead>
                                            <tr>
                                            	
        
                                                <th>Product</th>
                                                <th>Unit</th>
                                                <th>Qty</th>
                                                <th>Sale Price</th>
                                                
                                                <th>Amount</th>
                                                <th>SubTotal</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                      
                                            <!-- <tr>
                    
                                                <td>
                                             <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                            <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                                 <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                              <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                               <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                                <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                              <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                         		<td>
                                             <input required type="text" class="form-control" placeholder="Category">
                                         		</td>
                                               <td> <button type="button" value="Add row" class="btn waves-effect waves-light btn-danger">delete</button></td>

                                            </tr> -->
                                           
                                        </tbody>
                                      
                                    </table>
                                    
                                </div>
                          
                                       
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Order Note</label>
                                                    <textarea name="order_note" class="form-control" cols="4" rows="5"></textarea>   
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label class="control-label">Total Amount</label>
                                                    <input name="total_price" id="total_price" readonly value="0" required type="number" class="form-control" ></div>
                                            </div>
                                            
                                        </div>

                                        
                                    <!-- <div class="row">

                                    	 <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Final Amount</label>
                                                    <input required type="text" class="form-control" ></div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Amount Paid</label>
                                                    <input required type="text" class="form-control" ></div>
                                            </div>
                                             <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Balance</label>
                                                    <input required type="text" class="form-control" ></div>
                                            </div>
                                    </div> -->
                                  
                                    <h5 class="card-title mt-4">Shipping Details</h5>
                                     <hr>
                                        <!--/row-->
                                    <div class="row">
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Name</label>
                                                     <input required type="text" name="shipping_name" class="form-control" name="">
                                            </div>
                                        </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Email</label>
                                                    <input required type="Email" name="shipping_email" class="form-control" name="">
                                                    
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Cell No</label>
                                                    <input required="" type="text" name="shipping_cell" class="form-control" name="">
                                                    
                                            </div>
                                        </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label class="control-label">Address</label>
                                                    <input required type="text" name="shipping_address" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">Country</label>
                                                    <input required value="Norway" readonly type="text" class="form-control" >

                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label class="control-label">City</label>
                                                    <select required name="shipping_city" class="form-control">
                                                        {!! $city_dropdown !!}
                                                    </select>
                                                </div>
                                            </div>
                                        
                                    </div>
                                   
                                        <hr>
                                    </div>
                                    <div class="form-actions mt-5">
                                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
                                        <a href="{{ url('/admin/view-orders')}}"><button type="button" class="btn btn-dark">Cancel</button></a>
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
