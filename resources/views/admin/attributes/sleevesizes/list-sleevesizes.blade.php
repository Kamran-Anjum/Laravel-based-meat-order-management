@extends('layouts.adminLayout.admin-design')
@section('content')
<style type="text/css">
    #btnmrg{
        margin-left: -110px;
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
                        <h5 class="font-medium text-uppercase mb-0">List {{ $fittypes->name }} Sleeve Sizes</h5>

                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List {{ $fittypes->name }} Sleeve Size</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-2">
                    	<div class="button-group">
					    <a href="{{ url('admin/create-sleevesize/'.$fittypes->id) }}"><button type="button" class="btn waves-effect waves-light btn-success">Add New</button></a> 
					</div>
                    </div>
                    <div class="col-3">
                        <div id="btnmrg" class="button-group">
                        <a href="{{ url('admin/create-shirtrange/'.$fittypes->id) }}"><button type="button" class="btn waves-effect waves-light btn-success">Add New Shirt Range</button></a> 
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
                                                <th>Collar Size</th>
                                                <th>Sleeve Length</th>
                                                <th>Sleeve Xml Code</th>
                                                <th>Shirt Length</th>
                                                <th>Shirt Xml Code</th>
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($sleevesizes as $sleevesize)
                                        
                                            <tr>
                                                <td>{{$sleevesize->collarname}}</td>
                                                <td>{{$sleevesize->sleeve_length}}</td>
                                                <td>{{$sleevesize->sleeve_length_xml}}</td>
                                                <td>{{$sleevesize->shirt_length}}</td>
                                                <td>{{$sleevesize->shirt_length_xml}}</td>
                                                <td>{{$sleevesize->created_at}}</td>
                                                <td>{{$sleevesize->userName}}</td>
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button" class="btn waves-effect waves-light btn-info"><a href="#" class="text-white">View</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a href="{{ url('admin/edit-sleevesize/'.$sleevesize->id) }}" class="text-white">Edit</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-id="{{ $sleevesize->id }}" param-route="delete-sleevesize" href="javascript:">Remove</a></button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sleeve Length</th>
                                                <th>Sleeve Xml Code</th>
                                                <th>Shirt Length</th>
                                                <th>Shirt Xml Code</th>
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
