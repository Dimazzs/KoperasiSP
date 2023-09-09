<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Penarikan;
use App\Models\Simpanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    function index()
    {


        if (Auth::user()->role == 'ketua') {
            return redirect('index/ketua');
        } elseif (Auth::user()->role == 'admin') {
            return redirect('index/admin');
        } elseif (Auth::user()->role == 'anggota') {
            return redirect('index/anggota');
        }
    }
    function ketua()
    {
        return view('ketua.master_data.index');
    }
    function admin()
    {
        return view('admin.master_data.index');
    }
    function anggota()
    {
        return view('anggota.master_data.index');
    }
}
