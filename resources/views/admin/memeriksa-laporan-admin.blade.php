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
                    <h1 class="h3 mb-0 text-gray-800">Memeriksa Laporan</h1>
                </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-black">Data Pelaporan</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('memeriksa_laporan') }}" method="GET">
                                <div class="input-group mb-4">
                                    <input type="text" id="nama" name="nama" class="form-control" placeholder="Cari Nama Pelapor">
                                    <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control ml-2">
                                    <label class="text-sd">sd</label>
                                    <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control ml-2">
                                    <select class="form-select-js" name="jenis_kasus" id="jenis_kasus">
                                        <option selected disabled>Pilih Jenis Kasus</option>
                                        <option value="Bullying Fisik">Bullying Fisik</option>
                                        <option value="Bullying Verbal">Bullying Verbal</option>
                                        <option value="Bullying Non Verbal">Bullying Non Verbal</option>
                                        <option value="Bullying Relasional">Bullying Relasional</option>
                                        <option value="Cyber Bullying">Cyber Bullying</option>
                                        <option value="Dan lain-lain">Dan lain-lain</option>
                                    </select>
                                    <select class="form-select-sk" name="status_kasus" id="status_kasus">
                                        <option selected disabled>Pilih Status Kasus</option>
                                        <option value="Terkirim">Terkirim</option>
                                        <option value="Dibaca">Dibaca</option>
                                        <option value="Diproses">Diproses</option>
                                        <option value="Penyelesaian">Penyelesaian</option>
                                        <option value="Selesai">Selesai</option>
                                    </select>
                                    <button class="btn btn-primary" type="submit" id="btn-cari">
                                        <i class="fa-solid fa-magnifying-glass"></i> Cari
                                    </button>
                                    <button class="btn btn-warning" type="reset" id="btn-reset">
                                        <i class="fa-solid fa-rotate"></i> Reset
                                    </button>   
                                </div>
                            </form>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No</th>
                                            <th>Nama Pelapor</th>
                                            <th>
                                                <a href="{{ route('memeriksa_laporan', array_merge(request()->except('sort'), ['sort' => request('sort', 'desc') === 'asc' ? 'desc' : 'asc'])) }}">
                                                    @if(request('sort', 'desc') === 'asc')
                                                        &uarr;
                                                    @else
                                                        &darr;
                                                    @endif
                                                    Dibuat Tanggal
                                                </a>
                                            </th>
                                            <th>Tanggal Kejadian</th>
                                            <th>Tempat Kejadian</th>
                                            <th>Deskripsi Kejadian</th>
                                            <th>Nama Korban</th>
                                            <th>Jenis Kasus</th>
                                            <th>Status Kasus</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($kasuses as $kasus)
                                        <tr>
                                            <td></td>
                                            <td>{{ $kasus->nama_pelapor }}</td>
                                            <td>{{ \Carbon\Carbon::parse($kasus->created_at)->translatedFormat('d F Y') }}</td>
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
                                                <a href="{{ route('memeriksa_laporan_view', $kasus->id) }}" class="btn btn-sm btn-info mb-2" id="btn-view">
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