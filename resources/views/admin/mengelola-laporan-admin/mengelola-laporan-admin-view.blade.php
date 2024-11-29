@extends('admin.admin-layout.admin-layout')
@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard_admin') }}">
            <div class="sidebar-brand-icon">
                <i class="fa-solid fa-shield" style="color: #F8F4E1;"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PESIKABU</div>
        </a>

        <!-- Divider -->
        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard_admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Laporan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('memeriksa_laporan') }}">
                <i class="fa-solid fa-list-check"></i>
                <span>Memeriksa Laporan</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('mengelola_laporan') }}">
                <i class="fa-solid fa-bars-progress"></i>
                <span>Mengelola Laporan</span></a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Users
        </div>

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('mengelola_users') }}">
                <i class="fa-solid fa-users-gear"></i>
                <span>Mengelola Users</span></a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Panduan
        </div>

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('melihat_panduan_aplikasi_admin') }}">
                <i class="fa-solid fa-book"></i>
                <span>Melihat Panduan Aplikasi</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <div class="text-center d-md-none">
                    <button class="rounded-circle border-0" id="sidebarToggleTop">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->photo)
                            <img alt="User Photo" class="img-profile rounded-circle" width="30" height="30" src="{{ asset('uploads/photos_admin/'. Auth::user()->photo) }}">
                            @else
                            <img alt="User Photo" class="img-profile rounded-circle" width="30" height="30" src="{{ asset('image/image-profile-user-admin/user.png')}}">
                            @endif
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('menu_profile') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('menu_ganti_password') }}">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ganti password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('profile_pembuat') }}">
                                <i class="fa-solid fa-address-card fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile pembuat
                            </a>
                            <a class="dropdown-item" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Mengelola Laporan</h1>
                </div>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-black">Data Kasus Laporan</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>Dari Akun</td>
                                        <td>{{ $kasuses->name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pelapor</td>
                                        <td>{{ $kasuses->nama_pelapor }}</td>
                                    </tr>
                                    <tr>
                                        <td>No HP</td>
                                        <td>{{ $kasuses->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Kejadian</td>
                                        <td>{{ \Carbon\Carbon::parse($kasuses->tanggal_kejadian)->translatedFormat('d F Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tempat Kejadian</td>
                                        <td>{{ $kasuses->tempat_kejadian }}</td>
                                    </tr>
                                    <tr>
                                        <td>Deskripsi Kejadian</td>
                                        <td>{{ $kasuses->deskripsi_kejadian }}</td>
                                    </tr>
                                    <tr>
                                        <td>Bukti</td>
                                        <td> 
                                            @php
                                                $buktiPaths = json_decode($kasuses->bukti);
                                            @endphp

                                            @if(!empty($buktiPaths))
                                                @foreach($buktiPaths as $bukti)
                                                    <img src="{{ asset($bukti) }}" alt="Bukti" style="width: 150px; height: auto; border: 2px solid #26355D; margin: 3px">
                                                @endforeach
                                            @else
                                                Tidak ada bukti
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Nama Korban</td>
                                        <td>{{ $kasuses->nama_korban }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Pelaku</td>
                                        <td>{{ $kasuses->nama_pelaku }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nama Saksi</td>
                                        <td>{{ $kasuses->nama_saksi }}</td>
                                    </tr>
                                    <tr>
                                        <td>Jenis Kasus</td>
                                        <td>{{ $kasuses->jenis_kasus }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tindak Lanjut</td>
                                        <td>{{ $kasuses->tindak_lanjut}}</td>
                                    </tr>
                                    <tr>
                                        <td>Status Kasus</td>
                                        <td>{{ $kasuses->status_kasus }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Penggajuan</td>
                                        <td>{{ \Carbon\Carbon::parse($kasuses->created_at)->translatedFormat('d F Y') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <div class="text-center text-muted my-2" style="font-size: 14px;">Copyright &copy; <span id="currentYear"></span> - MDNP</div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection