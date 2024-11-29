<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kasus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function index()
    {

        $data = array(
            'title' => 'Selamat Datang Di PESIKABU',
        );

        return view('users.home-users', $data);
    }

    public function  menu_profile()
    {
        $data = array(
            'title' => 'Menu Profile',
        );

        return view('users.menu-profile-users', $data);
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
                $oldPhotoPath = public_path('uploads/photos_users/' . $user->photo);
                if (File::exists($oldPhotoPath)) {
                    File::delete($oldPhotoPath);
                }
            }

            $file = $request->file('photo');
            $photoName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/photos_users'), $photoName);

            $user->update(['photo' => $photoName]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui.');
    }

    public function menu_ganti_password_users()
    {

        $data = array(
            'title' => 'Menu ganti nama dan password',
        );

        return view('users.menu-ganti-password-users', $data);
    }

    public function proses_ganti_password_users(Request $request, $id)
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

        return redirect()->route('menu_ganti_password_users')->with('success', 'Data akun berhasil diubah');
    }

    public function  membuat_laporan()
    {

        $data = array(
            'title' => 'Membuat Laporan',
        );

        return view('users.membuat-laporan-users', $data);
    }

    public function proses_membuat_laporan(Request $request)
    {
        $this->validate($request, [
            'nama_pelapor'     => 'required|min:1',
            'no_hp'            => 'required|min:8',
            'tanggal_kejadian' => 'required|date',
            'tempat_kejadian'  => 'required|min:1',
            'deskripsi_kejadian' => 'required|min:2',
            'bukti.*'          => 'image|mimes:jpeg,jpg,png|max:5120',
            'nama_korban'      => '',
            'nama_pelaku'      => '',
            'nama_saksi'       => '',
        ]);

        $buktiPaths = [];
        if ($request->hasFile('bukti')) {
            foreach ($request->file('bukti') as $file) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads/bukti_kasus'), $fileName);
                $buktiPaths[] = 'uploads/bukti_kasus/' . $fileName;
            }
        }

        $user = Auth::user();

        Kasus::create([
            'id_user'           => $user->id,
            'name'              => $user->name,
            'nama_pelapor'      => $request->nama_pelapor,
            'no_hp'             => $request->no_hp,
            'tanggal_kejadian'  => $request->tanggal_kejadian,
            'tempat_kejadian'   => $request->tempat_kejadian,
            'deskripsi_kejadian' => $request->deskripsi_kejadian,
            'bukti'             => json_encode($buktiPaths),
            'nama_korban'       => $request->nama_korban,
            'nama_pelaku'       => $request->nama_pelaku,
            'nama_saksi'        => $request->nama_saksi,
        ]);

        return redirect()->back()->with('success', 'Laporan berhasil dikirim');
    }


    public function  melihat_laporan_saya()
    {
        $id_user = Auth::id();
        $kasuses = Kasus::where('id_user', $id_user)->get();

        $data = array(
            'title' => 'Melihat Laporan Saya',
        );

        return view('users.melihat-laporan-saya-users', compact('kasuses'), $data);
    }

    public function  selengkapnya_laporan_saya($id)
    {
        $id_user = Auth::id();
        $kasuses = Kasus::where('id_user', $id_user)->findOrFail($id);

        $data = array(
            'title' => 'Selengkapnya Laporan Saya',
        );

        return view('users.selengkapnya-laporan-saya-users', compact('kasuses'), $data);
    }


    public function  melihat_panduan_aplikasi_user()
    {
        $data = array(
            'title' => 'Melihat Panduan Aplikasi',
        );

        return view('users.melihat-panduan-aplikasi-users', $data);
    }
}
