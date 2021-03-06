<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


    <link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/dist/css/adminlte.min.css') }}">

    <!-- summernote -->
    <link rel="stylesheet" href="{{ URL::asset('assets/admin-lte/plugins/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- Bootstrap Switch -->
    <!-- <script src="{{ URL::asset('assets/admin-lte/plugins/bootstrap-switch/js/bootstrap-switch.min.js') }}"></script> -->
    <script type="text/javascript">
        var systemURL="{{ URL::asset('assets/plugin/') }}/";
    </script>
     <!-- jQuery -->
     <script src="{{ URL::asset('/assets/admin-lte/plugins/jQuery/jquery.min.js') }}"></script>
</head>




<!-- Header -->
@include('admin/header')
<!-- Sidebar -->
@include('admin/sidebar')
 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            <div class="col-sm-6">
                <h1>@yield('title')</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{URL::asset('')}}">Home</a></li>
                <li class="breadcrumb-item active">Blank Page</li>
                </ol>
            </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
     <!-- Your Page Content Here -->
         @yield('content')
    </section>
    <!-- /.content -->




   

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<footer class="main-footer">
    <strong>Copyright &copy; {{ date('Y')}} <a taget="_blank" href="https://www.qwords.com/">DEV Qwords</a>.</strong> All rights
    reserved.
</footer>
@include('admin/footer')