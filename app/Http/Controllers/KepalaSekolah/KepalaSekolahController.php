<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;

class KepalaSekolahController extends Controller
{
    public function index()
    {
        return view('kepalaSekolah.dashboard');
    }

    public function dataGuru()
    {
        $gurus = User::all();
        return view('admin.data-guru', compact('gurus'));
    }

    public function riwayatCutiGuru()
    {
        $cutiKonfirmasi = Cuti::where('status', 'Konfirmasi')->paginate(10);
        $cutiPending = Cuti::where('status', 'Pending')->paginate(10);

        return view('admin.riwayat-cuti-guru', compact('cutiPending', 'cutiKonfirmasi'));
    }
}
