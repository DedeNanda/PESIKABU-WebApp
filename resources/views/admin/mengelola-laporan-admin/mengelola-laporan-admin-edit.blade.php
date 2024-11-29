@extends('admin.admin-layout.admin-layout')
@section('content')

<div id="wrapper">

    <ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard_admin') }}">
            <div class="sidebar-brand-icon">
                <i class="fa-solid fa-shield" style="color: #F8F4E1;"></i>
            </div>
            <div class="sidebar-brand-text mx-3">PESIKABU</div>
        </a>

        <hr class="sidebar-divider my-0">

        <li class="nav-item active">
            <a class="nav-link" href="{{ route('dashboard_admin') }}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Dashboard</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Laporan
        </div>

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
                            <img alt="User Photo" class="img-profile rounded-circle" width="30" height="30" src="{{ asset('uploads/photos_admin/'. Auth::user()->photo) }}">
                            @else
                            <img alt="User Photo" class="img-profile rounded-circle" width="30" height="30" src="{{ asset('image/image-profile-user-admin/user.png')}}">
                            @endif
                        </a>
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
                    <h1 class="h3 mb-0 text-gray-800">Edit Data Kasus</h1>
                </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-black">Isi Data Kasus</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('update_mengelola_laporan_edit', $kasuses->id) }}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Nama Pelapor</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nama_pelapor" id="name_pelapor" value="{{ old('nama_pelapor', $kasuses->nama_pelapor) }}" placeholder="Masukan Nama Pelapor" required>
                                                    <small class="file-name-info">* Nama Boleh Samaran</small>
                                                    @error('nama_pelapor')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">No Hp/Wa</label>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp', $kasuses->no_hp) }}" placeholder="Masukan No Hp" required>
                                                    @error('no_hp')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Tanggal Kejadian</label>
                                                </td>
                                                <td>
                                                    <input type="date" class="form-control" name="tanggal_kejadian" id="tanggal_kejadian" value="{{ old('tanggal_kejadian', $kasuses->tanggal_kejadian) }}"  required>
                                                    @error('date')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Tempat Kejadian</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="tempat_kejadian" id="tempat_kejadian" value="{{ old('tempat_kejadian', $kasuses->tempat_kejadian) }}" placeholder="Masukan Tempat Kejadian" required>
                                                    @error('tempat_kejadian')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Deskripsi Kejadian</label>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="deskripsi_kejadian" id="deskripsi_kejadian" placeholder="Masukan Deskripsi Kejadian" required>{{ old('deskripsi_kejadian', $kasuses->deskripsi_kejadian) }}</textarea>
                                                    @error('deskripsi_kejadian')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label"> Ubah Bukti</label>
                                                </td>
                                                <td>
                                                    <input type="file" class="form-control py-1" name="bukti[]" id="bukti[]" multiple>
                                                    <small class="file-size-info">* Jika Anda memiliki bukti, silakan unggah. Mohon pastikan jumlah file yang diunggah tidak lebih dari 7 file foto dan ukuran setiap file foto tidak melebihi 5 MB. Jika menemukan foto baru maka foto lama akan hilang, berhati-hati saat ubah bukti.</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Nama Korban</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nama_korban" id="nama_korban" value="{{ old('nama_korban', $kasuses->nama_korban) }}" placeholder="Masukan Nama Korban">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Nama Pelaku</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nama_pelaku" id="nama_pelaku" value="{{ old('nama_pelaku', $kasuses->nama_pelaku) }}" placeholder="Masukan Nama Pelaku">
                                                    <small class="file-name-info">* Nama pelaku boleh tidak diisi jika Anda ragu atau belum pasti.</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Nama Saksi</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nama_saksi" id="nama_saksi" value="{{ old('nama_saksi', $kasuses->nama_saksi) }}" placeholder="Masukan Nama Saksi">
                                                    <small class="file-name-info">* Jika tidak ada saksi, boleh tidak diisi.</small>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Jenis Kasus</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="jenis_kasus" id="jenis_kasus" value="{{ old('jenis_kasus', $kasuses->jenis_kasus) }}" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Tindak Lanjut</label>
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="tindak_lanjut" id="tindak_lanjut" placeholder="Masukan Tindak Lanjut" required>{{ old('tindak_lanjut', $kasuses->tindak_lanjut) }}</textarea>
                                                    @error('tindak_lanjut')
                                                    <div class="alert alert-danger mt-2">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label class="form-label">Status Kasus</label>
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="status_kasus" id="status_kasus" value="{{ old('status_kasus', $kasuses->status_kasus) }}" placeholder="Masukan Nama Saksi" readonly>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary">Perbarui Kasus</button>
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