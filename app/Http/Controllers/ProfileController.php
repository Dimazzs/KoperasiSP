<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    public function index()
    {


        if (Auth::user()->role == 'ketua') {
            return view('ketua.master_data.profile');
        } elseif (Auth::user()->role == 'admin') {
            return view('admin.master_data.profile');
        } elseif (Auth::user()->role == 'anggota') {
            return view('anggota.master_data.profile');
        }
    }
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'pekerjaan' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:12'],

        ]);

        $user = User::findOrFail(Auth::user()->id);
        $user->update([
            'name' => $request->name,
        ]);
        $user->profile()->updateOrCreate(
            [
                'user_id' => $user->id
            ],
            [
                'alamat' => $request->alamat,
                'pekerjaan' => $request->pekerjaan,
                'jenis_kelamin' => $request->jenis_kelamin,
                'no_hp' => $request->no_hp,

            ]
        );
        return redirect()->back()->with('message', 'udah update');
    }

    //data anggota

    public function indexs(Request $request)
    {
        if ($request->has('cari')) {
            $data = Anggota::join('users', 'anggota.user_id', '=', 'users.id')
                ->where('users.name', 'like', '%' . $request->cari . '%')
                ->paginate(10);
        } else {
            $data = Anggota::orderBy('id', 'asc')->paginate(10);
        }
        return view('admin.master_data.data.anggota', compact('data', 'request'));
    }

    public function edit($id)
    {
        $data = Anggota::findOrFail($id);
        return view('admin.master_data.data.edit', compact('data', 'id'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => ['required', 'string'],
            'jenis_kelamin' => ['required', 'string'],
            'no_hp' => ['required', 'string', 'max:12'],
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->alamat = $request->input('alamat');
        $anggota->jenis_kelamin = $request->input('jenis_kelamin');
        $anggota->no_hp = $request->input('no_hp');
        $anggota->save();

        return redirect()->back()->with('message', 'Data anggota berhasil diperbarui');
    }

    public function indexk(Request $request)
    {

        if ($request->has('cari')) {
            $data = Anggota::join('users', 'anggota.user_id', '=', 'users.id')
                ->where('users.name', 'like', '%' . $request->cari . '%')
                ->paginate(10);
        } else {
            $data = Anggota::orderBy('id', 'asc')->paginate(10);
        }
        return view('ketua.master_data.data.anggota', compact('data', 'request'));
    }

    public function detail($id)
    {
        $data = Anggota::findOrFail($id);
        return view('ketua.master_data.data.detail', compact('data', 'id'));
    }
}
