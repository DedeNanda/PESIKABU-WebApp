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
                    <h1 class="h3 mb-0 text-gray-800">Melihat Laporan Saya</h1>
                </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-black">Data Pelaporan {{ Auth::user()->name }}</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th scope="col">No</th>
                                            <th scope="col">Nama Pelapor</th>
                                            <th scope="col">Tanggal Kejadian</th>
                                            <th scope="col">Tempat Kejadian</th>
                                            <th scope="col">Deskripsi Kejadian</th>
                                            <th scope="col">Nama Korban</th>
                                            <th scope="col">Jenis Kasus</th>
                                            <th scope="col">Status Kasus</th>
                                            <th scope="col">Selengkapnya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($kasuses as $kasus)
                                        <tr>
                                            <td></td>
                                            <td>{{ $kasus->nama_pelapor }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kasus->tanggal_kejadian)->translatedFormat('d F Y') }}</td>
                                            <td>{{ $kasus->tempat_kejadian }}</td>
                                            <td>
                                                <span class="truncated-text">
                                                    {{ $kasus->deskripsi_kejadian }}
                                                </span>
                                            </td>
                                            <td>{{ $kasus->nama_korban }}</td>
                                            <td>{{ $kasus->jenis_kasus }}</td>
                                            <td>{{ $kasus->status_kasus }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('selengkapnya_laporan_saya', $kasus->id) }}" class="btn btn-sm btn-info mb-2" id="btn">
                                                        <i class="fa-solid fa-eye"></i></i> View
                                                </a>
                                                
                                            </td>
                                        </tr>
                                        @empty
                                            <div class="alert alert-danger">
                                                Tidak ada pelaporan.
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end">
                                <ul id="pagination" class="pagination"></ul>
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