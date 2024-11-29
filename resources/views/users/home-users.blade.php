@extends('users.users-layout.users-layout')
@section('content')

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('halaman_utama_user') }}">
            <div class="sidebar-brand-icon">
                <i class="fa-solid fa-shield" style="color: #F8F4E1;"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PESIKABU</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('halaman_utama_user') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Halaman Utama</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Laporan
        </div>

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('membuat_laporan') }}">
                <i class="fa-solid fa-user-pen"></i>
                <span>Membuat Laporan</span></a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('melihat_laporan_saya') }}">
                <i class="fa-solid fa-eye"></i>
                <span>Melihat Laporan Saya</span></a>
        </li>

        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Panduan
        </div>

        <li class="nav-item active">
            <a class="nav-link" href="{{ route ('melihat_panduan_aplikasi_user') }}">
                <i class="fa-solid fa-book"></i>
                <span>Melihat Panduan Aplikasi</span></a>
        </li>

        <hr class="sidebar-divider d-none d-md-block">

        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

        
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <div class="text-center d-md-none">
                    <button class="rounded-circle border-0" id="sidebarToggleTop">
                        <i class="fa-solid fa-bars"></i>
                    </button>
                </div>

                <ul class="navbar-nav ml-auto">

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                            @if(Auth::user()->photo)
                            <img alt="User Photo" class="rounded-circle mx-auto d-block border border-dark" loading="lazy" width="35" id="user-photo" height="35" src="{{ asset('uploads/photos_users/'. Auth::user()->photo) }}">
                            @else
                            <img alt="User Photo" class="rounded-circle mx-auto d-block border border-dark" loading="lazy" width="35" id="user-photo" height="35" src="{{ asset('image/image-profile-user-admin/user.png')}}">
                            @endif
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="{{ route('menu_profile_user') }}">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{ route('menu_ganti_password_users') }}">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ganti password
                            </a>
                            <div class="dropdown-divider"></div>
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
                    <h1 class="h3 mb-0 text-gray-800">Halaman Utama</h1>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-white">Selamat Datang Di PESIKABU</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" width="100%" cellspacing="0">
                                <tbody>
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <div class="position-relative">
                                                <div class="spinner-border text-primary d-none" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                                @if(Auth::user()->photo)
                                                    <img alt="User Photo" class="img-profile rounded-circle" width="190" height="190" loading="lazy" id="photo-home" src="{{ asset('uploads/photos_users/'. Auth::user()->photo) }}">
                                                @else
                                                    <img alt="User Photo" class="img-profile rounded-circle" width="190" height="190" id="photo-home" src="{{ asset('image/image-profile-user-admin/user.png')}}">
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <td>{{ Auth::user()->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tanggal Pembuatan Akun</th>
                                        <td>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->isoFormat('D MMMM Y') }}</td>
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