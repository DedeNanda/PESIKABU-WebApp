<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index()
    {

        $data = array(
            'title' => 'Welcome to PESIKABU',
        );

        return view('home', $data);
    }

    public function login()
    {
        $data =  array(
            'title' => 'Login PESIKABU',
        );

        $user = Auth::user();

        if ($user) {
            if ($user->level == 'admin') {
                return redirect()->intended('admin');
            } else if ($user->level == 'user') {
                return redirect()->intended('user');
            }
        }
        return view('login', $data);
    }

    public function proses_login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credential = $request->only('email', 'password');

        if (Auth::attempt($credential)) {

            $user =  Auth::user();

            if ($user->level == 'admin') {
                return redirect()->intended('admin');
            } else if ($user->level == 'user') {
                return redirect()->intended('user');
            }

            return redirect()->intended('/');
        }
        return redirect('login')
            ->withInput()
            ->withErrors(['login_gagal' => 'Maaf Email dan Password Salah, Masukan dengan Benar']);
    }

    public function register()
    {
        $data = array(
            'title' => 'Register PESIKABU',
        );

        return view('register', $data);
    }

    public function proses_register(Request $request)
    {
        $validator =  Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email|string|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('/register')
                ->withErrors($validator)
                ->withInput();
        }

        $request['level'] = 'user';
        $request['password'] = bcrypt($request->password);

        User::create($request->all());

        return redirect()->route('login')->with('success', 'Akun telah berhasil dibuat! Silakan login.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();

        Auth::logout();
        return Redirect('login');
    }
}
