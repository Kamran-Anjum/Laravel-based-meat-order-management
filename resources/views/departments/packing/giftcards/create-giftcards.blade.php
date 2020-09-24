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
                        <h5 class="font-medium text-uppercase mb-0">Create Gift Card</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Create Gift Card</li>
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
                </style>
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- basic table -->
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form enctype="multipart/form-data" method="post" action="{{ url('/admin/create-giftcards') }}" name="" id=""> {{ csrf_field() }}
                            <h4 class="card-title">Add new Gift Card</h4>
                            <form class="needs-validation" novalidate>
                                <!-- <div class="row">
                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="">16 Digit Code Series</label>
                                            <input id="" type="text" class="form-control" value="400 " name="card_code" style="width: 100%; height:36px;" required>
                                           
                                            <div class="invalid-feedback">Example invalid Code</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-0">
                                        <div class="form-group">
                                            <label for="">Inser Your Series</label>
                                            <input type="number" name="" id="" class="form-control" style="width: 100%; height:36px;" required oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"type = "number" maxlength = "4">
                                            
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                </div> -->
                                <!-- <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Pin Code Series</label>
                                            <input type="text" class="form-control" id="" name="card_name" style="width: 100%; height:36px;" required>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for=""> Sub-Category</label>
                                            <select name="subcategorytype[]" id="productsubcategorydd" class="form-control" multiple="" style="width: 100%; height:36px;" required>
                                            </select>
                                            <div class="invalid-feedback">Example invalid custom select feedback</div>
                                        </div>
                                    </div>
                                </div>   -->

                                <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <p>16 Digit code and 4 Digit pin will auto generate</p>
                                            <input type="hidden" name="card_code" value="400">
                                            <label for="">Select Image</label>                                       
                                           <input  name="image"  type="file" class="form-control-file btn-file" required id="exampleInputFile" data-show-upload="true" data-show-caption="true">                                                                         
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                          <!--   <label for="product-code">Code</label>
                                            <input name="code" type="text" class="form-control" id="product-code" placeholder="" value="" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div> -->
                                        </div>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                            <label for="">Select Numbers To Create</label>                                       
                                           <input  name="counter"  type="number" class="form-control-file btn-file" required id="counter" >                                                                         
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mb-0">
                                        <div class="form-group">
                                          <!--   <label for="product-code">Code</label>
                                            <input name="code" type="text" class="form-control" id="product-code" placeholder="" value="" required>
                                            <div class="valid-feedback">
                                                Looks good!
                                            </div> -->
                                        </div>
                                    </div>
                                </div>  

                                           

                                <hr>
                                <div class="form-actions mt-5">
                                <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Add</button>
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
