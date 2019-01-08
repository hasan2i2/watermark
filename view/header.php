<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>سامانه مدیریت عکس</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link rel="stylesheet" href="<?= base_path('/assets/bootstrap/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_path('/assets/css/bootstrap-rtl.min.css') ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons 2.0.0 -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_path('/assets/css/AdminLTE.min.css') ?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= base_path('/assets/css/skins/_all-skins.min.css') ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_path('/assets/plugins/iCheck/flat/blue.css') ?>">
    <!-- Morris chart -->
    <link rel="stylesheet" href="<?= base_path('/assets/plugins/morris/morris.css') ?>">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?= base_path('/assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') ?>">
    <!-- Date Picker -->
    <link rel="stylesheet" href="<?= base_path('/assets/plugins/datepicker/datepicker3.css') ?>">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_path('/assets/plugins/daterangepicker/daterangepicker-bs3.css') ?>">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="<?= base_path('/assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') ?>">

    <link rel="stylesheet" href="<?= base_path('/assets/fonts/fonts-fa.css') ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>پایتخت</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>پایتخت</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="<?= base_path('/assets/img/user2-160x160.jpg') ?>" class="user-image"
                                 alt="User Image">
                            <span class="hidden-xs">کامران کیانلو</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="<?= base_path('/assets/img/user2-160x160.jpg') ?>" class="img-circle"
                                     alt="User Image">
                                <p>
                                    کامران کیانلو - مدیر سایت
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-right">
                                    <a href="#" class="btn btn-default btn-flat">پروفایل</a>
                                </div>
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">خروج</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-right image">
                    <img src="<?= base_path('/assets/img/user2-160x160.jpg') ?>" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>کامران کیانلو</p>
                    <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
                </div>
            </div>
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">ناوبری اصلی</li>
                <li class="active treeview">
                    <a href="#">
                        <i class="fa fa-dashboard"></i> <span>پیشخوان</span>
                    </a>
                </li>

                <li class="treeview">
                    <a href="#">
                        <i class="fa fa-briefcase"></i> <span>پروفایل ها</span> <i
                                class="fa fa-angle-left pull-left"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="<?= base_path('/profiles.php') ?>"><i class="fa fa-circle-o"></i> مدیریت پروفایل ها</a>
                        </li>
                        <li><a href="<?= base_path('/createProfile.php') ?>"><i class="fa fa-circle-o"></i> افزودن به
                                پروفایل</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="<?= base_path('/makeWatermark.php') ?>">
                        <i class="fa fa-picture-o"></i> <span>ایجاد واترمارک</span>
                    </a>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
