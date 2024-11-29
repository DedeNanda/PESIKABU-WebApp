<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//bagian tampilan
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::get('/register', [HomeController::class, 'register'])->name('register');

//bagian login
Route::post('/proses_login', [HomeController::class, 'proses_login'])->name('proses_login');
Route::post('/proses_register', [HomeController::class, 'proses_register'])->name('proses_register');
Route::get('/logout', [HomeController::class, 'logout'])->name('logout');
Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::resource('admin', AdminController::class);
    });
    Route::group(['middleware' => ['cek_login:user']], function () {
        Route::resource('user', UserController::class);
    });
});


// ini merupakan dari admin
Route::middleware(['auth'])->group(function () {

    //bagian tampilan admin
    Route::get('/dashboard_admin', [AdminController::class, 'index'])->name('dashboard_admin');

    //tampilan dari menu profile, ganti password, dan profile pembuat
    Route::get('/menu_profile', [AdminController::class, 'menu_profile'])->name('menu_profile');
    Route::get('/menu_ganti_password', [AdminController::class, 'menu_ganti_password'])->name('menu_ganti_password');
    Route::get('/profile_pembuat', [AdminController::class, 'profile_pembuat'])->name('profile_pembuat');

    //proses ubah photo dan ganti password di bagian admin
    Route::post('/proses_ubah_profile/{id}', [AdminController::class, 'proses_ubah_profile'])->name('proses_ubah_profile');
    Route::post('/proses_ganti_password/{id}', [AdminController::class, 'proses_ganti_password'])->name('proses_ganti_password');

    //bagian dari memeriksa laporan
    Route::get('/memeriksa_laporan', [AdminController::class, 'memeriksa_laporan'])->name('memeriksa_laporan');
    Route::get('/memeriksa_laporan_view/{id}', [AdminController::class, 'memeriksa_laporan_view'])->name('memeriksa_laporan_view');

    //bagian dari mengelola users
    Route::get('/mengelola_users', [AdminController::class, 'mengelola_users'])->name('mengelola_users');
    Route::get('/mengelola_users_tambah_akun_user', [AdminController::class, 'mengelola_users_tambah_akun_user'])->name('mengelola_users_tambah_akun_user');
    Route::post('/proses_mengelola_users_tambah_akun_users', [AdminController::class, 'proses_mengelola_users_tambah_akun_users'])->name('proses_mengelola_users_tambah_akun_users');
    Route::delete('/hapus_mengelola_users/{id}', [AdminController::class, 'hapus_mengelola_users'])->name('hapus_mengelola_users');
    Route::get('/mengelola_laporan_download', [AdminController::class, 'mengelola_laporan_download'])->name('mengelola_laporan_download');

    //bagian dari tampilan melihat panduan aplikasi
    Route::get('/melihat_panduan_aplikasi_admin', [AdminController::class, 'melihat_panduan_aplikasi_admin'])->name('melihat_panduan_aplikasi_admin');

    // bagian dari mengelola laporan di admin
    Route::get('/mengelola_laporan', [AdminController::class, 'mengelola_laporan'])->name('mengelola_laporan');
    Route::get('/mengelola_laporan_view/{id}', [AdminController::class, 'mengelola_laporan_view'])->name('mengelola_laporan_view');
    Route::get('/mengelola_laporan_tambahkan_kasus', [AdminController::class, 'mengelola_laporan_tambahkan_kasus'])->name('mengelola_laporan_tambahkan_kasus');
    Route::post('/proses_mengelola_laporan_tambahkan_kasus', [AdminController::class, 'proses_mengelola_laporan_tambahkan_kasus'])->name('proses_mengelola_laporan_tambahkan_kasus');
    Route::get('/mengelola_laporan_edit/{id}', [AdminController::class, 'mengelola_laporan_edit'])->name('mengelola_laporan_edit');
    Route::get('/mengelola_laporan_print_individu/{id}', [AdminController::class, 'mengelola_laporan_print_individu'])->name('mengelola_laporan_print_individu');
    Route::put('/update_mengelola_laporan_edit/{id}', [AdminController::class, 'update_mengelola_laporan_edit'])->name('update_mengelola_laporan_edit');
    Route::delete('/hapus_mengelola_laporan/{id}', [AdminController::class, 'hapus_mengelola_laporan'])->name('hapus_mengelola_laporan');
    Route::put('/update-status-kasus/{id}', [AdminController::class, 'status_kasus'])->name('update-status-kasus');
    Route::put('/update-jenis-kasus/{id}', [AdminController::class, 'jenis_kasus'])->name('update-jenis-kasus');
});



//ini merupakan bagian users
Route::middleware(['auth'])->group(function () {
    Route::get('/halaman_utama_user', [UserController::class, 'index'])->name('halaman_utama_user');
    Route::get('/menu_profile_user', [UserController::class, 'menu_profile'])->name('menu_profile_user');
    Route::get('/menu_ganti_password_users', [UserController::class, 'menu_ganti_password_users'])->name('menu_ganti_password_users');
    Route::get('/membuat_laporan', [UserController::class, 'membuat_laporan'])->name('membuat_laporan');
    Route::get('/melihat_laporan_saya', [UserController::class, 'melihat_laporan_saya'])->name('melihat_laporan_saya');
    Route::get('/melihat_panduan_aplikasi_user', [UserController::class, 'melihat_panduan_aplikasi_user'])->name('melihat_panduan_aplikasi_user');
    Route::get('/selengkapnya_laporan_saya/{id}', [UserController::class, 'selengkapnya_laporan_saya'])->name('selengkapnya_laporan_saya');

    //proses di bagian users
    Route::post('/proses_ubah_profile2/{id}', [UserController::class, 'proses_ubah_profile'])->name('proses_ubah_profile2');
    Route::post('/proses_membuat_laporan', [UserController::class, 'proses_membuat_laporan'])->name('proses_membuat_laporan');
    Route::post('/proses_ganti_password_users/{id}', [UserController::class, 'proses_ganti_password_users'])->name('proses_ganti_password_users');
});
