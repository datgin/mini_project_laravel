<!DOCTYPE html>
<html lang="en" dir="ltr">


<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="Andshop - Admin Dashboard HTML Template.">

    <title>Andshop - Admin Dashboard HTML Template.</title>

    <!-- GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap"
        rel="stylesheet">
    <link href="{{ asset('admin-assets/assets/css/materialdesignicons.min.css') }}" rel="stylesheet" />

    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('admin-assets/assets/plugins/daterangepicker/daterangepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('admin-assets/assets/plugins/simplebar/simplebar.css') }}" rel="stylesheet" />

    <!-- custom css -->
    <link id="style.css" href="{{ asset('admin-assets/assets/css/style.css') }}" rel="stylesheet" />

    @yield('css')

    <!-- FAVICON -->
    <link href="{{ asset('admin-assets/assets/img/favicon.png') }}" rel="shortcut icon" />

    <!-- SWAL -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body class="ec-header-fixed ec-sidebar-fixed ec-sidebar-light ec-header-light" id="body">

    <!--  WRAPPER  -->
    <div class="wrapper">

        @include('admin.layout.sidebar')

        <!--  PAGE WRAPPER -->
        <div class="ec-page-wrapper">

            @include('admin.layout.header')

            @yield('content')

            @include('admin.layout.footer')

        </div> <!-- End Page Wrapper -->
    </div> <!-- End Wrapper -->

    <!-- Common Javascript -->

    <script src="{{ asset('admin-assets/assets/plugins/jquery/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/plugins/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/plugins/jquery-zoom/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/plugins/slick/slick.min.js') }}"></script>

    <!-- Chart -->
    <script src="{{ asset('admin-assets/assets/plugins/charts/Chart.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/chart.js') }}"></script>

    @yield('script')

    <!-- Google map chart -->
    <script src="{{ asset('admin-assets/assets/plugins/charts/google-map-loader.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/plugins/charts/google-map.js') }}"></script>

    <!-- Date Range Picker -->
    <script src="{{ asset('admin-assets/assets/plugins/daterangepicker/moment.min.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin-assets/assets/js/date-range.js') }}"></script>
    <!-- custom js -->
    <script src="{{ asset('admin-assets/assets/js/custom.js') }}"></script>


</body>


</html>
