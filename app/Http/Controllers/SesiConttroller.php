<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SesiConttroller extends Controller
{
    function index()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,

        ];
        if (Auth::attempt($infologin)) {
            if (Auth::user()->role == 'ketua') {
                return redirect('index/ketua');
            } elseif (Auth::user()->role == 'admin') {
                return redirect('index/admin');
            } elseif (Auth::user()->role == 'anggota') {
                return redirect('index/anggota');
            }
        } else {
            return redirect('')->withErrors('Email dan Password yang dimasukkan tidak sesuai ')->withInput();
        }
    }
    function logout()
    {
        Auth::logout();
        return redirect('');
    }
    function register()
    {
        return view('admin.master_data.register');
    }
    function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'nik' => 'required|unique:anggota',
            'pekerjaan' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'tgl_lahir' => 'required',
            'simpanan_pokok' => 'required|numeric|min:50000|max:50000',
            'no_hp' => 'required'
        ], [
            'name.required' => 'Nama wajib diisi',
            'nik.required' => 'Nik Wajib diisi',
            'nik.unique' => 'Nik sudah ada',
            'pekerjaan.required' => 'pekejaan Wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Silahkan masukan email yang valid',
            'email.unique' => 'Email sudah ada silahkan pilih email yang lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimum password yang diijinkan adalah 8 karakter',
            'role.required' => 'Divisi wajib dipilih',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih',
            'alamat.required' => 'Alamat wajib diisi',
            'tgl_lahir.required' => 'Tanggal lahir wajib diisi',
            'no_hp.required' => 'No hp wajib diisi',
            'simpanan_pokok.required' => 'simpanan pokok 50.000',
            'simpanan_pokok.min' => 'simpanan pokok harus 50.000',
            'simpanan_pokok.max' => 'simpanan pokok harus 50.000',


        ]);



        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ];

        $user = User::create($data);
        Anggota::create([
            'nik' => $request['nik'],
            'pekerjaan' => $request['pekerjaan'],
            'jenis_kelamin' => $request['jenis_kelamin'],
            'alamat' => $request['alamat'],
            'tgl_lahir' => $request['tgl_lahir'],
            'no_hp' => $request['no_hp'],
            'simpanan_pokok' => $request['simpanan_pokok'],
            'user_id' => $user->id
        ]);


        $infologin = [
            'email' => $request->email,
            'password' => $request->password,

        ];
        if ($infologin) {
            return redirect()->back()->with('message', 'berhasil buat akun');
        }
    }
}
