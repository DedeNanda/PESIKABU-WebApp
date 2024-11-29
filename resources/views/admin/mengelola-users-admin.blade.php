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
                    <h1 class="h3 mb-0 text-gray-800">Mengelola Users</h1>
                </div>
                @if(session('success'))
                <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button id="closeSuccessAlert" type="button" class="btn-close" aria-label="Close">&times;
                    </button>
                </div>
                @endif
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-black">Data Akun Users</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3" style="max-width: 100%;">
                            <form action="{{ route('mengelola_users') }}" method="GET"> 
                                <div class="input-group mb-3">
                                    <input type="text" id="searchInput" name="nama" class="form-control" placeholder="Cari nama akun" value="">
                                    <input type="date" id="dateInput" name="tanggal" class="form-control" value="">
                                    <button class="btn btn-primary" type="submit"  id="btn-cari">
                                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                                    </button>
                                    <button class="btn btn-warning" type="reset">
                                        <i class="fa-solid fa-rotate"></i> Reset
                                    </button>
                                </div>
                            </form>   
                            <a href="{{ route('mengelola_users_tambah_akun_user') }}" class="btn btn-sm btn-secondary shadow-sm">
                                <i class="fa-solid fa-plus fa-lg"></i> Tambahkan Akun User
                            </a>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Photo</th>
                                        <th>
                                            <a href="{{ route('mengelola_users', array_merge(request()->except('sort'), ['sort' => request('sort', 'desc') === 'asc' ? 'desc' : 'asc'])) }}">
                                            @if(request('sort', 'desc') === 'asc')
                                                &uarr;
                                            @else
                                                &darr;
                                            @endif
                                            Tanggal Dibuat
                                            </a>
                                        </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($users as $user)
                                    <tr>
                                        <td></td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->masked_email }}</td>
                                        <td>{{ $user->level }}</td>
                                        <td class="text-center align-middle">
                                            @if($user->photo)
                                                <img src="{{ asset('uploads/photos_users/' . $user->photo) }}" alt="Photo" style="width: 70px; height: auto;">
                                            @else
                                                Tidak ada photo
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            {{ \Carbon\Carbon::parse($user->created_at)->isoFormat('D MMMM Y') }}
                                        </td>
                                        <td class="text-center">
                                            <form onsubmit="return confirm('Apakah Anda Yakin Menghapus Akun User?');" action="{{ route('hapus_mengelola_users', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fa-solid fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    <div class="alert alert-danger">
                                        Tidak ada akun tersebut.
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