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
                        <h5 class="font-medium text-uppercase mb-0">List Monograms</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List Monogram</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                    	<div class="button-group">
					    <a href="{{ url('admin/create-monogram') }}"><button type="button" class="btn waves-effect waves-light btn-success">Add New</button></a> 
					</div>
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
<!--                                 <h4 class="card-title">Zero Configuration</h4>
                                <h6 class="card-subtitle">DataTables has most features enabled by default, so all you
                                    need to do to use it with your own tables is to call the construction
                                    function:<code> $().DataTable();</code>. You can refer full documentation from here
                                    <a href="https://datatables.net/">Datatables</a></h6> -->
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped border">
                                        <thead>
                                            <tr>
                                                <th>Code</th>
                                                <th>Font Type</th>
                                                <th>Location Type</th>
                                                <th>Color</th>
                                                <th>Initial</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @foreach($monograms as $monogram)
                                            <tr>
                                                <td>{{$monogram->code}}</td>
                                                <td>{{$monogram->fontName}}</td>
                                                <td>{{$monogram->locationName}}</td>
                                                <td>{{$monogram->color}}</td>
                                                <td>{{$monogram->initial}}</td>
                                                <td>{{$monogram->description}}</td>
                                                                  <td>
                    @if(!empty($monogram->image))

                    <img src=" {{ asset('/images/backend-images/liburtiimages/attributes/tiny/'.$monogram->image ) }}">
                    @endif
                  </td>
                                                <td>{{$monogram->created_at}}</td>
                                                <td>{{$monogram->userName}}</td>
                                                <!-- <td>$320,800</td> -->
                                                <td>
                                                	<div class="button-group">
														
                                                        <button type="button" class="btn waves-effect waves-light btn-info"><a class="text-white" href="{{ url('/admin/view-monograms')}}">View</a></button>

                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a class="text-white" href="{{ url('admin/edit-monogram/'.$monogram->id) }}">Edit</a></button>

                                                        <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{ $monogram->id }}" param-route="delete-monogram" href="javascript:">Remove</a></button>

                                                        <!-- <button type="button" class="btn waves-effect waves-light btn-info">View</button>
														<a href=" {{ url('admin/edit-monogram/'.$monogram->id) }}" type="button" class="btn waves-effect waves-light btn-primary">Edit</a>
														<a param-id="{{ $monogram->id }}" param-route="delete-monogram" href="javascript:" type="button" class="btn waves-effect waves-light btn-danger sa-confirm-delete">Remove</a> -->
													</div>
												</td>

                                            </tr>
                                        @endforeach
                                             <!-- <tr>
                                                <td>6079</td>
                                                <td>Blue</td>
                                                <td>Dark Bluish</td>
                                                <td>2012/08/28</td>
                                                <td>Admin</td>
                                                                                                <td>
                                                	<div class="button-group">
														<button type="button" class="btn waves-effect waves-light btn-info">View</button>
														<button type="button" class="btn waves-effect waves-light btn-primary">Edit</button>
														<button type="button" class="btn waves-effect waves-light btn-danger">Remove</button>
													</div>
												</td>
                                            </tr>
                                            <tr>
                                                <td>4568</td>
                                                <td>Black</td>
                                                <td>Hot look</td>
                                                <td>2015/07/11</td>
                                                <td>Admin</td>
                                                <td>
                                                	<div class="button-group">
														<button type="button" class="btn waves-effect waves-light btn-info">View</button>
														<a href="{{ url('admin/edit-colors') }}"><button type="button" class="btn waves-effect waves-light btn-primary">Edit</button></a>
														<button id="sa-confirm" type="button" class="btn waves-effect waves-light btn-danger">Remove</button>
													</div>
												</td>
                                            </tr>  -->
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Code</th>
                                                <th>Font Type</th>
                                                <th>Location Type</th>
                                                <th>Color</th>
                                                <th>Initial</th>
                                                <th>Description</th>
                                                <th>Image</th>
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Action</th>
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
