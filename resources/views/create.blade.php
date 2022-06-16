<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('template/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('template/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo"
             height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="/" class="nav-link">Dashboard</a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <img src="{{ asset('template/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
                 class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Admin Panel</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel user-end mt-3 pb-3 mb-3">
                <div class="info" style="display: unset !important;">
                    <a href="/user/profile" style="margin-left: 5px;">{{ Auth::user()->name }}</a>
                         <form action="{{ route('logout') }}" method="post" style="float: right !important;">
                     @csrf
                      <button type="submit" class="nav-item" style="margin-right: 10px;">Logout</button>
                        </form>
                </div>
            </div>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <li class="nav-item menu-open">
                        <a href="/" class="nav-link active">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Resource
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="/data/Hewan" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Hewan</p>
                                </a>
                                <li class="nav-item">
                                <a href="/data/Buah" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Buah</p>
                                </a>   
                                <li class="nav-item">
                                <a href="/data/Tumbuhan" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Tumbuhan</p>
                                </a>
                                <li class="nav-item">
                                <a href="/data/Benda" class="nav-link active">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Data Benda</p>
                                </a> 
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"></h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <h3 class="text-center text-danger"><b>Buat Data {{$category}} Baru</b></h3>
                    <div class="form-group">
                        <form action="/post/{{$category}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" class="form-control m-2" placeholder="Nama"
                                   required
                                   aria-required="true">
                            <label for="title">Nama Lain</label>
                            <input type="text" id="title" name="title" class="form-control m-2" placeholder="Inggrisnya"
                                   required
                                   aria-required="true">
                            <label for="image">File Gambar</label>
                            <input type="file" id="input-file-now-custom-3 image" class="form-control m-2" name="image"
                                   required
                                   aria-required="true">
                            <label for="sound">File Suara</label>
                            <input type="file" id="input-file-now-custom-3 sound" class="form-control m-2" name="sound"
                                   required
                                   aria-required="true">
                            <div style="text-align: center">
                                <a class="btn btn-primary mt-3" href="/data/{{$category}}" role="button">Back</a>
                                <button type="submit" class="btn btn-danger mt-3">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('template/dist/js/adminlte.js')}}"></script>
<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('template/plugins/jquery-mousewheel/jquery.mousewheel.js')}}"></script>
<script src="{{ asset('template/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{ asset('template/plugins/jquery-mapael/jquery.mapael.min.js')}}"></script>
<script src="{{ asset('template/plugins/jquery-mapael/maps/usa_states.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{ asset('template/plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('template/dist/js/pages/dashboard2.js')}}"></script>
<script>
    let collection = document.getElementsByClassName('disclaimer')
    for (let name of collection) {
        console.log(name)
        name.remove()
    }
</script>
</html>

















