<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    public function searchAnggota(Request $request)
    {
        $term = $request->term;

        $anggotas = Anggota::where('nik', 'LIKE', "%$term%")
            ->orWhere('nama', 'LIKE', "%$term%")
            ->get();

        $results = [];

        foreach ($anggotas as $anggota) {
            $results[] = [
                'value' => $anggota->id,
                'label' => $anggota->nik . ' - ' . $anggota->nama,
            ];
        }

        return response()->json($results);
    }
}
