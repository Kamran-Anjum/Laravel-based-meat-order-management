<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/backend-images/favicon.png ') }}">
    <title>Liburti</title>
	<link rel="canonical" href="#" />
    <!-- This Page CSS -->
    <link href=" {{ asset('css/backend-css/assets/libs/chartist/dist/chartist.min.css') }}" rel="stylesheet">
    <link href=" {{ asset('js/backend-js/pages/chartist/chartist-init.css ') }}" rel="stylesheet">
    <link href="{{ asset('css/backend-css/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css') }}" rel="stylesheet">
    <link href="{{ asset('css/backend-css/assets/extra-libs/jvector/jvector.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/backend-css/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/backend-css/assets/libs/morris.js/morris.css') }}" rel="stylesheet">
    <!-- needed css -->
    <link href="{{ asset('css/backend-css/style.min.css ') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- This page plugin CSS -->
    <link href="{{ asset('css/backend-css/assets/extra-libs/datatables.net-bs4/css/dataTables.bootstrap4.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('css/backend-css/assets/extra-libs/datatables.net-bs4/css/responsive.dataTables.min.css') }}">
    <!-- Sweet Alert -->
    <link href="{{ asset('css/backend-css/assets/libs/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
    <!-- Select dropdown -->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend-css/assets/libs/select2/dist/css/select2.min.css') }}">
    <!-- Product upload image-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/backend-css/assets/libs/magnific-popup/dist/magnific-popup.css') }}">
    


    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->

@include('layouts.productionLayout.production-header')
@include('layouts.productionLayout.production-sidebar')



@yield('content')

@include('layouts.productionLayout.production-footer')
</div>
    <div class="chat-windows"></div>
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('css/backend-css/assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('css/backend-css/assets/libs/popper.js/dist/umd/popper.min.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/libs/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- apps -->
    <script src="{{ asset('js/backend-js/app.min.js') }}"></script>
    <script src="{{ asset('js/backend-js/app.init.mini-sidebar.js') }}"></script>
    <script src="{{ asset('js/backend-js/app-style-switcher.js') }}"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="{{ asset('css/backend-css/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/extra-libs/sparkline/sparkline.js') }}"></script>
    <!--Wave Effects -->
    <script src="{{ asset('js/backend-js/waves.js') }}"></script>
    <!--Menu sidebar -->
    <script src="{{ asset('js/backend-js/sidebarmenu.js') }}"></script>
    <!--Custom JavaScript -->
    <script src="{{ asset('js/backend-js/custom.min.js') }}"></script>
    <!-- This Page JS -->
    <script src="{{ asset('css/backend-css/assets/libs/chartist/dist/chartist.min.js') }}"></script>
    <script src="{{ asset('js/backend-js/pages/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/libs/raphael/raphael.min.js')}}"></script>
    <script src="{{ asset('css/backend-css/assets/libs/morris.js/morris.min.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/libs/echarts/dist/echarts-en.min.js') }}"></script>
    <script src="{{ asset('js/backend-js/pages/dashboards/dashboard6.js') }}"></script>
    <!--This page plugins -->
    <script src="{{ asset('css/backend-css/assets/extra-libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/extra-libs/datatables.net-bs4/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/backend-js/pages/datatable/datatable-basic.init.js') }}"></script>
    <!-- Sweet Alert -->
    <script src="{{ asset('css/backend-css/assets/libs/sweetalert2/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/libs/sweetalert2/sweet-alert.init.js') }}"></script>
    <!-- Custom Sweet Alert and Validation -->
    <script src="{{ asset('js/backend-js/liburti.form_validation.js') }}"></script>
    <!-- Select dropdown -->
    <script src="{{ asset('css/backend-css/assets/libs/select2/dist/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/libs/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('js/backend-js/pages/forms/select2/select2.init.js') }}"></script>
    <!-- product edit image -->
    <script src="{{ asset('css/backend-css/assets/libs/magnific-popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('css/backend-css/assets/libs/magnific-popup/meg.init.js') }}"></script>
   
</html>
