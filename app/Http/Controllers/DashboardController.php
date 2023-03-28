<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Member;
use App\Models\Mentor;
use App\Models\Modul;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function GetAll()
    {
        $mbrAktif = User::where('status_akun', '=', 'aktif')->count();
        $mbrNonaktif = User::where('status_akun', '=', 'nonaktif')->count();
        $user = User::all();
        $kls = Kelas::all()->count();
        $mdl = Modul::all()->count();

        $tra = Transaksi::all()->groupBy('id_member')->count();
        $mbr = User::all();
        $data = Lembaga::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.dashboard', [
                'title' => 'Dashboard',
                'instansi' => $data,
                'member_aktif' => $mbrAktif,
                'member_non' => $mbrNonaktif,
                'kelas' => $kls,
                'modul' => $mdl,
            ]);
        } elseif (Auth::user()->role == 'mentor') {
            return view('mentors.dashboard', [
                'title' => 'Dashboard',
                'instansi' => $data,
                'user' => $user
            ]);
        } elseif (Auth::user()->role == 'member') {
            return view('members.dashboard', [
                'title' => 'Dashboard',
                'instansi' => $data,
                'kelas' => $kls,
                "transaksi" => $tra,
                'user' => $user
            ]);
        } else {
            print('akses di tolak');
        }
    }
}
