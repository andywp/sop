<?php
$user = Auth::user();
?>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link img-panel" data-toggle="dropdown" href="#">
                        <div class="media">
                            <img class="mr-2" style="width:35px; height:35px; object-fit: cover;" src="http://sso.qwords.com/public/uploads/{{ $user->photo }}" alt="Generic placeholder image">
                            <div class="media-body">
                                <h6 class="mt-0 mt-1">{{ $user->name}} {{$user->division}} </h6>
                            </div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="{{ url('logout') }}" class="dropdown-item">
                            <!-- Message Start -->
                            <div class="media">
                                 <i class="fas fa-sign-out-alt mt-1 mr-3"></i>
                                <div class="media-body">
                                    <P>Log Out</p>
                                </div>
                            </div>
                            <!-- Message End -->
                        </a>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->