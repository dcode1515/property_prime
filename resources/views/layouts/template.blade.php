<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="keyword" content="">
    <meta name="author" content="" />
    <!-- Page Title -->
    <title>LAPMS V1 - DASHBOARD</title>
    <!-- Datepicket CSS -->
    <link href="{{ URL::asset('public/avesta-main/html/assets/plugins/daterangepicker/daterangepicker.css') }}"
        rel="stylesheet" type="text/css">
    {{-- <link href="{{ URL::asset('public/avesta-main/html/assets/plugins/chartist/chartist.css') }}" rel="stylesheet"
        type="text/css"> --}}
    {{-- <link href="{{ URL::asset('public/avesta-main/html/assets/plugins/jqvmap/jquery-jvectormap-2.0.2.css') }}"
        rel="stylesheet" type="text/css"> --}}
    <link href="{{ URL::asset('public/avesta-main/html/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ URL::asset('public/avesta-main/html/assets/images/favicon.ico') }}" rel="icon"
        type="image/x-icon">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        {{-- <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
  integrity="sha384-dfXpCmYn9VE2gZOpssF4b4OVGrB6ay0Umbh8VTPf59UZx79qfY5J2teOrCjhOuK9"
  crossorigin="anonymous"/> --}}


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
    <style>
        .page-content {
            min-height: 100vh;
            /* Set minimum height to 100% of viewport height */
            display: flex;
            flex-direction: column;
        }

        .page-footer {
            margin-top: auto;
            /* Push the footer to the bottom */
        }
    </style>
</head>

<body>
    <!--================================-->
    <!-- Page Container Start -->
    <!--================================-->
    <div class="page-container">
        <!--================================-->
        <!-- Page Sidebar Start -->
        <!--================================-->
        <div class="page-sidebar">
            <div class="logo">
                <a class="logo-img" href="">
                    <img src="{{ URL::asset('public/images/logo.png') }}" alt="" style="width:100px;"/>
                    {{-- <img class="small-logo" src="assets/images/small-logo.png" alt=""> --}}
                </a>
                <a id="sidebar-toggle-button-close"><i class="wd-20" data-feather="x"></i> </a>
            </div>
            <!--================================-->
            <!-- Sidebar Menu Start -->
            <!--================================-->
            @include('layouts.sidebar')
            <!--/ Sidebar Menu End -->
            <!--================================-->
            <!-- Sidebar Footer Start -->
            <!--================================-->

            <!--/ Sidebar Footer End -->
        </div>
        <!--/ Page Sidebar End -->
        <!--================================-->
        <!-- Page Content Start -->
        <!--================================-->
        <div class="page-content">
            <!--================================-->
            <!-- Page Header Start -->
            <!--================================-->
            @include('layouts.navbar')
            <!--/ Page Header End -->
            <!--================================-->
            <!-- Page Inner Start -->
            <!--================================-->
            @yield('content')
            <!--/ Page Inner End -->
            <!--================================-->
            <!-- Page Footer Start -->
            <!--================================-->
            <footer class="page-footer">
                <div class="pd-t-4 pd-b-0 pd-x-20">
                    <div class="tx-10 tx-uppercase tx-gray-500 tx-spacing-1">
                        <p class="pd-y-10 mb-0">Copyright&copy; 2021 | Created By <a
                                href="https://wrapcoders.xyz/avesta" target="_blank">WRAPCODERS</a></p>
                    </div>
                </div>
            </footer>
            <!--/ Page Footer End -->
        </div>
        <!--/ Page Content End -->
    </div>
    <!--/ Page Container End -->
    <!--================================-->
    <!-- Scroll To Top Start-->
    <!--================================-->
    <a href="" data-click="scroll-top" class="btn-scroll-top fade"><i class="fa fa-arrow-up"></i></a>
    <!--/ Scroll To Top End -->
    <!--================================-->
    <!-- Template Customizer Start-->
    <!--================================-->
   
    <!--/ Template Customizer End -->
    <!--================================-->
    <!-- Footer Script -->
    <!--================================-->
    <script src="{{ asset('public/js/app.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/popper/popper.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/feather/feather.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/typeahead/typeahead.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/typeahead/typeahead-active.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/pace/pace.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/highlight/highlight.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    {{-- <script src="{{ asset('public/avesta-main/html/assets/plugins/jqvmap/jquery-jvectormap-2.0.2.min.js') }}"></script> --}}
    <script src="{{ asset('public/avesta-main/html/assets/plugins/jqvmap/gdp-data.js') }}"></script>
    {{-- <script src="{{ asset('public/avesta-main/html/assets/plugins/jqvmap/maps/jquery-jvectormap-world-mill-en.js') }}">
    </script> --}}
    {{-- <script src="{{ asset('public/avesta-main/html/assets/plugins/chartist/chartist.js') }}"></script> --}}
    {{-- <script src="{{ asset('public/avesta-main/html/assets/plugins/apex-chart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/apex-chart/irregular-data-series.js') }}"></script> --}}
    <script src="{{ asset('public/avesta-main/html/assets/plugins/flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/plugins/flot/sampledata.js') }}"></script>
    {{-- <script src="{{ asset('public/avesta-main/html/assets/js/dashboard/sales-dashboard-init.js') }}"></script> --}}
    <script src="{{ asset('public/avesta-main/html/assets/js/app.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/js/avesta.js') }}"></script>
    <script src="{{ asset('public/avesta-main/html/assets/js/avesta-customizer.js') }}"></script>


   
</body>

</html>
