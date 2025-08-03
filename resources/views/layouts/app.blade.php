<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> PT TRI ADI BERSAMA   - Admin Dashboard</title>
    <link rel="icon" type="image/png" href="{{asset('images/logo.jpg')}}">

    <!-- Google Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif !important;
            background: linear-gradient(135deg, #ffeef8 0%, #f8f9fa 100%);
        }

        /* Custom Pink Theme */
        .main-header.navbar {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(255, 107, 157, 0.2) !important;
        }

        .main-header .navbar-nav .nav-link {
            color: white !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .main-header .navbar-nav .nav-link:hover {
            color: #fff !important;
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
            transform: translateY(-1px);
        }

        .main-header .fas.fa-bars {
            color: white !important;
            font-size: 1.1rem;
        }

        /* Sidebar Pink Theme */
        .main-sidebar {
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%) !important;
            box-shadow: 4px 0 15px rgba(255, 107, 157, 0.1) !important;
        }

        .brand-link {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            color: white !important;
            border-bottom: 1px solid rgba(255, 107, 157, 0.3) !important;
            padding: 20px 15px !important;
            text-align: center !important;
        }

        .brand-text {
            font-weight: 700 !important;
            font-size: 1.2rem !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .brand-link::before {
            content: '🌸';
            margin-right: 8px;
            font-size: 1.3rem;
        }

        /* Sidebar Navigation */
        .nav-sidebar .nav-item .nav-link {
            color: #ecf0f1 !important;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 2px 8px;
        }

        .nav-sidebar .nav-item .nav-link:hover {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            color: white !important;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
        }

        .nav-sidebar .nav-item.menu-open > .nav-link,
        .nav-sidebar .nav-item .nav-link.active {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            color: white !important;
            box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3);
        }

        /* Content Area */
        .content-wrapper {
            background: linear-gradient(135deg, #ffeef8 0%, #ffffff 50%, #f8f9fa 100%) !important;
            min-height: calc(100vh - 57px);
            position: relative;
        }

        .content-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: 
                url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ff6b9d' fill-opacity='0.03'%3E%3Ccircle cx='30' cy='30' r='4'/%3E%3Ccircle cx='10' cy='10' r='2'/%3E%3Ccircle cx='50' cy='50' r='2'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            opacity: 0.5;
            z-index: 0;
        }

        .content-wrapper > * {
            position: relative;
            z-index: 1;
        }

        /* Cards and Alerts */
        .card {
            border: none !important;
            border-radius: 15px !important;
            box-shadow: 0 8px 25px rgba(255, 107, 157, 0.1) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(255, 107, 157, 0.15) !important;
        }

        .card-header {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            color: white !important;
            border: none !important;
            border-radius: 15px 15px 0 0 !important;
            font-weight: 600;
        }

        .alert {
            border-radius: 12px !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
        }

        .alert-success {
            background: linear-gradient(135deg, #ff9ff3 0%, #ffeef8 100%) !important;
            color: #c44569 !important;
            border-left: 4px solid #ff6b9d !important;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffcccb 0%, #ffe6e6 100%) !important;
            color: #d63384 !important;
            border-left: 4px solid #dc3545 !important;
        }

        .alert-info {
            background: linear-gradient(135deg, #e7f3ff 0%, #f0f8ff 100%) !important;
            color: #0dcaf0 !important;
            border-left: 4px solid #0dcaf0 !important;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(255, 107, 157, 0.3) !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 25px rgba(255, 107, 157, 0.4) !important;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
        }

        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
        }

        .btn-danger {
            background: linear-gradient(135deg, #dc3545 0%, #e91e63 100%) !important;
            border: none !important;
            border-radius: 10px !important;
            font-weight: 600 !important;
        }

        /* Tables */
        .table {
            background: rgba(255, 255, 255, 0.9) !important;
            border-radius: 12px !important;
            overflow: hidden !important;
        }

        .table thead th {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            color: white !important;
            border: none !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background: rgba(255, 107, 157, 0.05) !important;
            transform: scale(1.01);
        }

        /* Footer */
        .main-footer {
            background: linear-gradient(135deg, #2c3e50 0%, #34495e 100%) !important;
            color: #ecf0f1 !important;
            border-top: 3px solid #ff6b9d !important;
            box-shadow: 0 -4px 15px rgba(255, 107, 157, 0.1) !important;
        }

        .main-footer a {
            color: #ff6b9d !important;
            text-decoration: none !important;
            transition: color 0.3s ease;
        }

        .main-footer a:hover {
            color: #ff9ff3 !important;
        }

        /* Dropdown */
        .dropdown-menu {
            border: none !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 30px rgba(255, 107, 157, 0.2) !important;
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        .dropdown-item {
            transition: all 0.3s ease !important;
            border-radius: 8px !important;
            margin: 2px 8px !important;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%) !important;
            color: white !important;
            transform: translateX(5px);
        }

        /* Form Controls */
        .form-control {
            border: 2px solid #f1c0e8 !important;
            border-radius: 10px !important;
            transition: all 0.3s ease !important;
            background: rgba(255, 255, 255, 0.9) !important;
        }

        .form-control:focus {
            border-color: #ff6b9d !important;
            box-shadow: 0 0 0 0.2rem rgba(255, 107, 157, 0.25) !important;
            background: white !important;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #ff6b9d 0%, #c44569 100%);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #c44569 0%, #ff6b9d 100%);
        }

        /* Loading Animation */
        @keyframes sparkle {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.7; transform: scale(1.1); }
        }

        .sparkle {
            animation: sparkle 2s ease-in-out infinite;
        }
    </style>
    
    @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false">
                    <i class="fas fa-user-circle me-2"></i>
                    <strong>{{ Auth::user()->nama }}</strong>
                </a>
                <div class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">
                    <a href="{{ route('admin.profile.show') }}" class="dropdown-item">
                        <i class="mr-2 fas fa-user-edit" style="color: #ff6b9d;"></i>
                        {{ __('My profile') }}
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class="dropdown-item"
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="mr-2 fas fa-sign-out-alt" style="color: #dc3545;"></i>
                            {{ __('Log Out') }}
                        </a>
                    </form>
                </div>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="/" class="brand-link">
            <span class="brand-text font-weight-bold text-center d-block">Anteraja </span>

        </a>

        @include('layouts.navigation')
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper mt-2">
        @if(session()->has('message'))
            <div class="container-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert alert-{{ session()->get('alert-info') }}">
                                {{ session()->get('message')}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if ($errors->any())
        <div class="container-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <ul class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
        <div class="p-3">
            <h5>Title</h5>
            <p>Sidebar content</p>
        </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline sparkle">
            <i class="fas fa-heart" style="color: #ff6b9d;"></i> Made with Love
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2025 <a href="#" style="color: #ff6b9d;"> PT TRI ADI BERSAMA</a>.</strong> 
        All rights reserved. Powered by <a href='#' title='Universitas Nurdin Hamzah' target='_blank' style="color: #ff9ff3;">Universitas Nurdin Hamzah</a>
    </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

@vite('resources/js/app.js')
<!-- AdminLTE App -->
<script src="{{ asset('js/adminlte.min.js') }}" defer></script>

@yield('scripts')
</body>
</html>
