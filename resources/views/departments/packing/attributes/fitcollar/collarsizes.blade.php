@extends('layouts.adminLayout.admin-design')
@section('content')
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        
<style type="text/css">


.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 127px;
  height: 42px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}
</style>
           
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                                    <div class="container-fluid">
                                        <br>
                                    <div class="stepwizard">
                            <div class="stepwizard-row setup-panel">
                                <div class="stepwizard-step">
                                    <a href="#step-1"><button class="btn btn-primary btn-circle">Classic Collar Size</button></a>
                               
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-2"><button class="btn btn-primary btn-circle">Slim Collar Size</button></a>
                                 
                                </div>
                                <div class="stepwizard-step">
                                    <a href="#step-3"><button class="btn btn-primary btn-circle">Extra Slim Collar Size</button></a>
                                 
                                </div>
                            </div>
                        </div>
                        </div>
                    
                                        <div class="row setup-content" id="step-1">
                         
                                <div class="col-md-12">
                                
                    <div class="page-breadcrumb">
                <div class="row">                                   
                            <div class="col-lg-4 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0"></h5>
                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="button-group">
                        <a ><button type="button" class="btn waves-effect waves-light btn-success">Add New</button></a> 
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
        </div>
        <div class="col-12">
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
                                                <th>Name</th>
                                                <th>Description</th>
                                                <!-- <th>Image</th> -->
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button" class="btn waves-effect waves-light btn-info"><a  class="text-white">View</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a  class="text-white">Edit</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete"  param-route="delete-collarsize" href="javascript:">Remove</a></button>
                                                    </div>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <!-- <th>Image</th> -->
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
                                </div>
                         
                        </div>
                        <div class="row setup-content" id="step-2" >
                            
                                <div class="col-md-12">
                                
                    <div class="page-breadcrumb">
                <div class="row">                                   
                            <div class="col-lg-4 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0"></h5>
                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page"></li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="button-group">
                        <a ><button type="button" class="btn waves-effect waves-light btn-success">Add New</button></a> 
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
        </div>
        <div class="col-12">
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
                                                <th>Name</th>
                                                <th>Description</th>
                                                <!-- <th>Image</th> -->
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button" class="btn waves-effect waves-light btn-info"><a href="{{ url('/admin/view-collarsize/')}}" class="text-white">View</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a  class="text-white">Edit</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete" param-route="delete-collarsize" href="javascript:">Remove</a></button>
                                                    </div>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <!-- <th>Image</th> -->
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
                                </div>
                        </div>


                                 <div class="row setup-content" id="step-3">
                                    <div class="col-md-12">
                                
                    <div class="page-breadcrumb">
                <div class="row">                                   
                            <div class="col-lg-4 col-md-4 col-xs-12 align-self-center">
                        <h5 class="font-medium text-uppercase mb-0">List Collar</h5>
                    </div>
                    <div class="col-lg-8 col-md-4 col-xs-12 align-self-center">
                        <!-- <button class="btn btn-danger text-white float-right ml-3 d-none d-md-block">Buy Ample
                            Admin</button> -->
                        <nav aria-label="breadcrumb" class="mt-2 float-md-right float-left">
                            <ol class="breadcrumb mb-0 justify-content-end p-0">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List Collar</li>
                            </ol>
                        </nav>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="button-group">
                        <a ><button type="button" class="btn waves-effect waves-light btn-success">Add New</button></a> 
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
        </div>
        <div class="col-12">
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
                                                <th>Name</th>
                                                <th>Description</th>
                                                <!-- <th>Image</th> -->
                                                <th>Created On</th>
                                                <th>Added By</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        
                                            <tr>
                                                
                                                <td>
                                                    <div class="button-group">
                                                        <button type="button" class="btn waves-effect waves-light btn-info"><a href="{{ url('/admin/view-collarsize/')}}" class="text-white">View</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-primary"><a  class="text-white">Edit</a></button>
                                                        <button type="button" class="btn waves-effect waves-light btn-danger"><a class="text-white sa-confirm-delete"  param-route="delete-collarsize" href="javascript:">Remove</a></button>
                                                    </div>
                                                </td>
                                            </tr>
                                           
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <!-- <th>Image</th> -->
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
                                </div>
                                    </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
           
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
<script type="text/javascript">
    $(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();
    $('#step-2').hide();

    // navListItems.click(function (e) {
    //     e.preventDefault();
    //     var $target = $($(this).attr('href')),
    //             $item = $(this);

    //     if (!$item.hasClass('disabled')) {
    //         navListItems.removeClass('btn-primary').addClass('btn-default');
    //         $item.addClass('btn-primary');
    //         allWells.hide();
    //         $target.show();
    //         $target.find('input:eq(0)').focus();
    //     }
    // });



    $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
@endsection
