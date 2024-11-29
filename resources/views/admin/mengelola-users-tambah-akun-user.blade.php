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
                <div class="col">
                    @if(session('success'))
                        <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button id="closeSuccessAlert" type="button" class="btn-close" aria-label="Close">&times;
                            </button>
                        </div>
                    @endif
                </div>
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tambahkan Akun User</h1>
                </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-black">Isi Data Akun User</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('proses_mengelola_users_tambah_akun_users') }}" method="POST" id="regFromAdmin">
                                {{ csrf_field() }}
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Nama</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="name" id="name_pelapor" placeholder="Masukan Nama Pelapor" required>
                                                    @error('name')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Email</label>
                                                </td>
                                                <td>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" required>
                                                    @error('email')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Password</label>
                                                </td>
                                                <td>
                                                    <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password" required>
                                                    @error('password')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Ulangi Password</label>
                                                </td>
                                                <td>
                                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Ulangi Password" required>
                                                    @error('password_confirmation')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>

                                                </td>
                                                <td>
                                                    {!! NoCaptcha::renderJs() !!}
                                                    {!! NoCaptcha::display() !!}
                                                    @error('g-recaptcha-response')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Buat Akun</button>
                                    </div>
                                </div>
                            </form>
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