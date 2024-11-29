@extends('users.users-layout.users-layout')
@section('content')
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('halaman_utama_user') }}">
            <div class="sidebar-brand-icon">
                <i class="fa-solid fa-shield" style="color: #F8F4E1;"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PESIKABU</div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('halaman_utama_user') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Halaman Utama</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Laporan
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
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

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item active">
            <a class="nav-link" href="{{ route ('melihat_panduan_aplikasi_user') }}">
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
            <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 40vh;">
                <div class="row w-100 justify-content-center">
                    <div class="col-md-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h4 class="m-0 font-weight-bold text-center">Ganti password</h4>
                            </div>
                            @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="card-body">
                                <div class="row justify-content-center">
                                    <div class="col-md-8">
                                        <div class="card mx-auto" style="max-width: 25rem;"> 
                                            @if(Auth::user()->photo)
                                                <img alt="User Photo" class="rounded-circle mx-auto d-block border border-primary border-2 shadow" width="160" id="user-photo" height="160" loading="lazy" src="{{ asset('uploads/photos_users/'. Auth::user()->photo) }}">
                                            @else
                                                <img alt="User Photo" class="rounded-circle mx-auto d-block border border-primary border-2 shadow" width="160" height="160" loading="lazy" src="{{ asset('image/image-profile-user-admin/user.png')}}">
                                            @endif
                                            <div class="card-body">
                                                {{-- di dalam form proses ganti nama dan password di buat dengan pemanggilan Auth::id() --}}
                                                <form action="{{ route('proses_ganti_password_users', Auth::id() ) }}"  method="POST" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <div class="mb-3">
                                                        <label for="password_lama" class="form-label mb-0">Password Lama</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" name="password_lama" id="password_lama" value="" autocomplete="current-password">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" onclick="showPassword('password_lama')">
                                                                    <span style="margin-left: 5px;">Lihat</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('password_lama')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label mb-0">Password Baru</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" name="password" id="password" value="" autocomplete="new-password">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" onclick="showPassword('password')">
                                                                    <span style="margin-left: 5px;">Lihat</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('password')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="password_confirmation" class="form-label mb-0">Konfirmasi Password Baru</label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" value="" autocomplete="new-password">
                                                            <div class="input-group-append">
                                                                <div class="input-group-text">
                                                                    <input type="checkbox" onclick="showPassword('password_confirmation')">
                                                                    <span style="margin-left: 5px;">Lihat</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @error('password_confirmation')
                                                        <div class="alert alert-danger mt-2">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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