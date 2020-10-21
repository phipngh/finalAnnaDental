<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Abstack - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('AdminSide/images/favicon.ico')}}">

    <!-- App css -->
    <link href="{{asset('AdminSide/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('AdminSide/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    <!-- Addition Style -->
    @yield('style')
    <!-- End Addition Style -->

</head>

<body>

<!-- Begin page -->
<div id="wrapper">


    @include('master.admin.topbar')


    @include('master.admin.menubar')




    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->
        <div class="content-page">
            <div class="content">
                <!-- Start Content-->
                <div class="container-fluid">
                    <!-- start page title -->
                    


                    @yield('content')

                <!-- end page title -->
                </div> <!-- end container-fluid -->
            </div> <!-- end content -->
        </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->

    @include('master.admin.footer')
    @include('master.admin.rightbar')

</div>
<!-- END wrapper -->



<!-- Vendor js -->
<script src="{{asset('AdminSide/js/vendor.min.js')}}"></script>

<!-- App js -->
<script src="{{asset('AdminSide/js/app.min.js')}}"></script>


<!-- Addition Script -->
@yield('script')
<!-- End Addition Script -->


</body>
</html>
