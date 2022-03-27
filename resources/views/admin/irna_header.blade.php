<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Palms Hotel</title>
        <link rel="icon" href="{{asset('images/logo.png')}}">
        <link href="{{asset('asset_admin/source_offline/dataTables.min.css')}}" rel="stylesheet" />
        <link href="{{asset('asset_admin/css/styles.css')}}" rel="stylesheet" />
        <script src="{{asset('asset_admin/source_offline/all.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('asset_admin/source_offline/bootstrap.bundle.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('asset_admin/js/scripts.js')}}"></script>
        <script src="{{asset('asset_admin/source_offline/Chart.min.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('asset_admin/source_offline/simple-datatables.js')}}" crossorigin="anonymous"></script>
        <script src="{{asset('asset_admin/source_offline/jquery.min.js')}}"></script>
        <script src="{{asset('asset_admin/source_offline/jquery.dataTables.min.js')}}"></script>
        <link href="{{asset('asset_admin/source_offline/select2.min.css')}}" rel="stylesheet" />
        <link href="{{asset('asset_admin/css/tagsinput.css')}}" rel="stylesheet"/>
        <script src="{{asset('asset_admin/source_offline/select2.min.js')}}"></script>
    </head>
    <style type="text/css">
        .bootstrap-tagsinput .tag {
        margin-right: 2px;
        color: white !important;
        background-color: #0d6efd;
        padding: 0.2rem;
        }
    </style>
    <div class="overlay">
        <div class="load">
            <div class="ring"></div>
            <div class="ring"></div>
            <div class="ring"></div>
            <p>Tunggu Sebentar...</p>
        </div>
    </div>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3"><img src="{{asset('images/logo.png')}}" style="max-width: 30px; border-radius:50%; background-color:#bfb6b6"> Palms Hotel</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <a class="nav-link"href="/logout">Logout <i class="fas fa-power-off"></i></a>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Utama</div>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Data</div>
                            @if(ucWords(session('user')['role']) == 'Admin')
                            <a class="nav-link" href="/pengguna">
                                <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                                Data Pengguna
                            </a>
                            <a class="nav-link" href="/role">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-group"></i></div>
                                Data Role
                            </a>
                            <a class="nav-link" href="/kamar">
                                <div class="sb-nav-link-icon"><i class="fas fa-bed"></i></div>
                                Data Kamar
                            </a>
                            <a class="nav-link" href="/tipe">
                                <div class="sb-nav-link-icon"><i class="fas fa-bed"></i></div>
                                Data Tipe
                            </a>
                            <a class="nav-link" href="/fasilitas">
                                <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                                Data Fasilitas
                            </a>
                            @else
                            <a class="nav-link" href="/data-reservasi">
                                <div class="sb-nav-link-icon"><i class="fas fa-gear"></i></div>
                                Data Reservasi
                            </a>
                            <a class="nav-link" href="/data-tamu">
                                <div class="sb-nav-link-icon"><i class="fas fa-user-group"></i></div>
                                Data Tamu
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Selamat Datang {{ucwords(session('user')['role'])}} :</div>
                        {{ucwords(session('user')['nama'])}}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
