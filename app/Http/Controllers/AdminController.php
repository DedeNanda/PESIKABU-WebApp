<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Kasus;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AdminController extends Controller
{
    public function index()
    {
        $jumlahUsers = User::where('level', '=', 'user')->count();

        $jumlahLaporan = Kasus::count();
        $jumlahkasusTerkirim = Kasus::where('status_kasus', '=', 'Terkirim')->count();
        $jumlahkasusDibaca = Kasus::where('status_kasus', '=', 'Dibaca')->count();
        $jumlahkasusDiproses = Kasus::where('status_kasus', '=', 'Diproses')->count();
        $jumlahkasusPenyelesaian = Kasus::where('status_kasus', '=', 'Penyelesaian')->count();
        $jumlahkasusSelesai = Kasus::where('status_kasus', '=', 'Selesai')->count();

        $data = array(
            'title' => 'Selamat Datang Admin',
        );

        return view('admin.home-admin', compact('jumlahUsers', 'jumlahLaporan', 'jumlahkasusTerkirim', 'jumlahkasusDibaca', 'jumlahkasusDiproses', 'jumlahkasusPenyelesaian', 'jumlahkasusSelesai'), $data);
    }

    public function  menu_profile()
    {
        $data = array(
            'title' => 'Menu Profile',
        );

        return view('admin.menu-profile-admin', $data);
    }

    public function proses_ubah_profile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'photo' => 'image|mimes:jpeg,png,jpg|max:5120',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        if ($request->hasFile('photo')) {
            if ($user->photo) {
                $oldPhotoPath = public_path('uploads/photos_admin/' . $user->photo);
                if (File::exists($oldPhotoPath)) {
                    File::delete($oldPhotoPath);
                }
            }

            $file = $request->file('photo');
            $photoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/photos_admin'), $photoName);

            $user->update(['photo' => $photoName]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function menu_ganti_password()
    {

        $data = array(
            'title' => 'Menu ganti nama dan password'
        );

        return view('admin.menu-ganti-password-admin', $data);
    }

    public function proses_ganti_password(Request $request, $id)
    {

        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::findOrFail($id);

        if ($request->filled('password')) {
            if (!Hash::check($request->password_lama, $user->password)) {
                return redirect()->back()->withInput()->withErrors(['password_lama' => 'Password lama tidak sesuai']);
            }
        }

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('menu_ganti_password')->with('success', 'Data akun berhasil diubah');
    }

    public function profile_pembuat()
    {

        $data = array(
            'title' => 'Profile Pembuat',
        );

        return view('admin.menu-profile-pembuat-admin', $data);
    }

    public function memeriksa_laporan(Request $request)
    {
        $user = Auth::user();
        $kasuses = collect();
        $sort = $request->get('sort', 'desc');

        if ($user->level === 'admin') {
            $query = Kasus::query();

            if ($request->has('nama') && $request->nama != '') {
                $query->where('nama_pelapor', 'like', '%' . $request->nama . '%');
            }

            if ($request->has('tanggal_mulai') && $request->tanggal_mulai != '') {
                $query->whereDate('created_at', '>=', $request->tanggal_mulai);
            }

            if ($request->has('tanggal_selesai') && $request->tanggal_selesai != '') {
                $query->whereDate('created_at', '<=', $request->tanggal_selesai);
            }

            if ($request->has('jenis_kasus') && $request->jenis_kasus != '') {
                $query->where('jenis_kasus', $request->jenis_kasus);
            }

            if ($request->has('status_kasus') && $request->status_kasus != '') {
                $query->where('status_kasus', $request->status_kasus);
            }

            $query->orderBy('created_at', $sort);

            $kasuses = $query->get();
        }

        $data = array(
            'title' => 'Memeriksa Laporan',
        );

        return view('admin.memeriksa-laporan-admin', compact('kasuses'), $data);
    }

    public function memeriksa_laporan_view($id)
    {

        $user = Auth::user();
        $kasuses = Kasus::findOrFail($id);

        if ($user->role === 'admin' && !$kasuses) {
            return redirect()->route('memeriksa_laporan_view')->with('error', 'Laporan tidak ditemukan.');
        }

        $data = array(
            'title' => 'Memeriksa Laporan View',
        );

        return view('admin.memeriksa-laporan-admin-view', compact('kasuses'), $data);
    }


    public function  mengelola_laporan(Request $request)
    {
        $user = Auth::user();
        $kasuses = collect();
        $sort = $request->get('sort', 'desc');

        if ($user->level === 'admin') {
            $query = Kasus::query();

            if ($request->has('nama') && $request->nama != '') {
                $query->where('nama_pelapor', 'like', '%' . $request->nama . '%');
            }

            if ($request->has('tanggal_mulai') && $request->tanggal_mulai != '') {
                $query->whereDate('created_at', '>=', $request->tanggal_mulai);
            }

            if ($request->has('tanggal_selesai') && $request->tanggal_selesai != '') {
                $query->whereDate('created_at', '<=', $request->tanggal_selesai);
            }

            if ($request->has('jenis_kasus') && $request->jenis_kasus != '') {
                $query->where('jenis_kasus', $request->jenis_kasus);
            }

            if ($request->has('status_kasus') && $request->status_kasus != '') {
                $query->where('status_kasus', $request->status_kasus);
            }

            $query->orderBy('created_at', $sort);

            $kasuses = $query->get();
        }

        $data = array(
            'title' => 'Mengelola Laporan',
        );

        return view('admin.mengelola-laporan-admin', compact('kasuses'), $data);
    }

    public function mengelola_laporan_view($id)
    {

        $user = Auth::user();
        $kasuses = Kasus::findOrFail($id);

        if ($user->role === 'admin' && !$kasuses) {
            return redirect()->route('mengelola_laporan_view')->with('error', 'Laporan tidak ditemukan.');
        }

        $data = array(
            'title' => 'Mengelola Laporan View',
        );

        return view('admin.mengelola-laporan-admin.mengelola-laporan-admin-view', compact('kasuses'), $data);
    }

    public function mengelola_laporan_tambahkan_kasus()
    {

        $data = array(
            'title' => 'Mengelola Laporan Tambahkan Kasus',
        );

        return view('admin.mengelola-laporan-admin.mengelola-laporan-admin-tambah-kasus', $data);
    }

    public function proses_mengelola_laporan_tambahkan_kasus(Request $request)
    {

        $this->validate($request, [
            'nama_pelapor'       => 'required|min:1',
            'no_hp'              => 'required|min:8',
            'tanggal_kejadian'   => 'required|date',
            'tempat_kejadian'    => 'required|min:1',
            'deskripsi_kejadian' => 'required|min:2',
            'bukti.*'            => 'image|mimes:jpeg,jpg,png|max:5120',
            'nama_korban'        => '',
            'nama_pelaku'        => '',
            'nama_saksi'         => '',
        ]);

        $buktiPaths = [];
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                if ($file->isValid()) {
                    $fileName = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/bukti_kasus'), $fileName);
                    $buktiPaths[] = 'uploads/bukti_kasus/' . $fileName;
                }
            }
        }

        $user = Auth::user();

        Kasus::create([
            'id_user'            => $user->id,
            'name'               => $user->name,
            'nama_pelapor'       => $request->nama_pelapor,
            'no_hp'              => $request->no_hp,
            'tanggal_kejadian'   => $request->tanggal_kejadian,
            'tempat_kejadian'    => $request->tempat_kejadian,
            'deskripsi_kejadian' => $request->deskripsi_kejadian,
            'bukti'              => json_encode($buktiPaths),
            'nama_korban'        => $request->nama_korban,
            'nama_pelaku'        => $request->nama_pelaku,
            'nama_saksi'         => $request->nama_saksi,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dibuat');
    }

    public function  mengelola_laporan_edit($id)
    {
        $user = Auth::user();
        $kasuses = Kasus::findOrFail($id);

        if ($user->role === 'admin' && !$kasuses) {
            return redirect()->route('mengelola_laporan_view')->with('error', 'Laporan tidak ditemukan.');
        }

        $data = array(
            'title' => 'Mengelola Users',
        );

        return view('admin.mengelola-laporan-admin.mengelola-laporan-admin-edit', compact('kasuses'), $data);
    }

    public function  update_mengelola_laporan_edit(Request $request, $id)
    {
        $this->validate($request, [
            'nama_pelapor'       => 'required|min:1',
            'no_hp'              => 'required|min:8',
            'tanggal_kejadian'   => 'required|date',
            'tempat_kejadian'    => 'required|min:1',
            'deskripsi_kejadian' => 'required|min:2',
            'bukti.*'            => 'image|mimes:jpeg,jpg,png|max:5120',
            'nama_korban'        => '',
            'nama_pelaku'        => '',
            'nama_saksi'         => '',
            'tindak_lanjut'      => '',
        ]);

        $kasus = Kasus::findOrFail($id);
        $buktiPaths = json_decode($kasus->bukti, true) ?: [];

        if ($request->hasFile('bukti')) {
            foreach ($buktiPaths as $oldPath) {
                if (Storage::exists('public/' . $oldPath)) {
                    Storage::delete('public/' . $oldPath);
                }
            }
            $buktiPaths = [];

            foreach ($request->file('bukti') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/bukti_kasus'), $fileName);
                $buktiPaths[] = 'uploads/bukti_kasus/' . $fileName;
            }
        }

        $kasus->update([
            'nama_pelapor'       => $request->nama_pelapor,
            'no_hp'              => $request->no_hp,
            'tanggal_kejadian'   => $request->tanggal_kejadian,
            'tempat_kejadian'    => $request->tempat_kejadian,
            'deskripsi_kejadian' => $request->deskripsi_kejadian,
            'bukti'              => json_encode($buktiPaths),
            'nama_korban'        => $request->nama_korban,
            'nama_pelaku'        => $request->nama_pelaku,
            'nama_saksi'         => $request->nama_saksi,
            'tindak_lanjut'      => $request->tindak_lanjut,
        ]);

        return redirect()->back()->with('success', 'Data Kasus berhasil Diubah');
    }

    public function hapus_mengelola_laporan($id)
    {
        $kasus = Kasus::findOrFail($id);

        $buktiPaths = json_decode($kasus->bukti, true);
        if ($buktiPaths) {
            foreach ($buktiPaths as $path) {
                Storage::delete('public/' . $path);
            }
        }

        $kasus->delete();

        return redirect()->route('mengelola_laporan')->with('success', 'Data Kasus Berhasil Dihapus!');
    }

    public function status_kasus(Request $request, $id)
    {

        $request->validate([
            'status_kasus' => 'in:Terkirim,Dibaca,Diproses,Penyelesaian,Selesai'
        ]);

        $kasus = Kasus::findOrFail($id);
        $kasus->status_kasus = $request->status_kasus;
        $kasus->save();

        return response()->json(['success' => true]);
    }

    public function jenis_kasus(Request $request, $id)
    {
        $request->validate([
            'jenis_kasus' => 'in:Bullying Fisik,Bullying Verbal,Bullying Non Verbal,Bullying Relasional,Cyber Bullying,Dan lain-lain'
        ]);

        $kasus = Kasus::findOrFail($id);
        $kasus->jenis_kasus = $request->jenis_kasus;
        $kasus->save();

        return response()->json(['success' => true]);
    }

    public function mengelola_laporan_print_individu($id)
    {
        $kasuses = Kasus::where('id', $id)->get();

        $jenis_kasus = $kasuses->first()->jenis_kasus;

        $pdf = Pdf::loadView('admin.mengelola-laporan-admin.mengelola-laporan-admin-print', compact('kasuses', 'jenis_kasus'));
        $pdf->setPaper('a4', 'landscape');
        $filename = 'laporan_kasus_bullying.pdf';

        return $pdf->stream($filename, ['Attachment' => false]);
    }

    public function mengelola_laporan_download(Request $request)
    {

        $query = Kasus::query();

        $query->when($request->has('nama') && $request->nama != '', function ($q) use ($request) {
            return $q->where('nama_pelapor', 'like', '%' . $request->nama . '%');
        });

        $query->when($request->has('tanggal_mulai') && $request->tanggal_mulai != '', function ($q) use ($request) {
            return $q->whereDate('created_at', '>=', $request->tanggal_mulai);
        });

        $query->when($request->has('tanggal_selesai') && $request->tanggal_selesai != '', function ($q) use ($request) {
            return $q->whereDate('created_at', '<=', $request->tanggal_selesai);
        });

        $query->when($request->has('jenis_kasus') && $request->jenis_kasus != '', function ($q) use ($request) {
            return $q->where('jenis_kasus', $request->jenis_kasus);
        });

        $query->when($request->has('status_kasus') && $request->status_kasus != '', function ($q) use ($request) {
            return $q->where('status_kasus', $request->status_kasus);
        });

        $kasuses = $query->get();

        $pdf = Pdf::loadView('admin.mengelola-laporan-admin.mengelola-laporan-admin-download', [
            'kasuses' => $kasuses,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'jenis_kasus' => $request->jenis_kasus,
        ]);
        $pdf->setPaper('a4', 'landscape');

        $filename = 'laporan_kasus_bullying.pdf';

        return $pdf->stream($filename, ['Attachment' => false]);
    }

    public function  mengelola_users(Request $request)
    {
        $query = User::where('level', 'user');
        $sort = $request->get('sort', 'desc');

        if ($request->has('nama') && $request->nama != '') {
            $query->where('name', 'like', '%' . $request->nama . '%');
        }

        if ($request->has('tanggal') && $request->tanggal != '') {
            $query->whereDate('created_at', $request->tanggal);
        }

        $query->orderBy('created_at', $sort);

        $users = $query->get();

        $data = array(
            'title' => 'Mengelola Users',
        );

        return view('admin.mengelola-users-admin', compact('users'), $data);
    }

    public function mengelola_users_tambah_akun_user()
    {

        $data = array(
            'title' => 'Mengelola Users Tambah Akun User',
        );

        return view('admin.mengelola-users-tambah-akun-user', $data);
    }

    public function proses_mengelola_users_tambah_akun_users(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/mengelola_users_tambah_akun_user')
                ->withErrors($validator)
                ->withInput();
        }

        $request['level'] = 'user';
        $request['password'] = bcrypt($request->password);

        User::create($request->all());

        return redirect()->route('mengelola_users_tambah_akun_user')->with('success', 'Akun telah berhasil dibuat! Silakan login.');
    }

    public function hapus_mengelola_users($id)
    {
        $user = User::find($id);

        $user->delete();

        return redirect()->back()->with('success', 'User berhasil di hapus');
    }

    public function  melihat_panduan_aplikasi_admin()
    {
        $data = array(
            'title' => 'Melihat Panduan Aplikasi',
        );

        return view('admin.melihat-panduan-aplikasi-admin', $data);
    }
}
