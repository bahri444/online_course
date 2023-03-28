<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Bidang;
use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Member;
use App\Models\Modul;
use App\Models\Question;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearnKelas extends Controller
{

    public function ReadKelas()
    {
        $user = User::all();
        $kelas = Kelas::all();
        $inst = Lembaga::all();
        $kelas = Kelas::all();
        $modul = Modul::all();
        $quis = Question::all();
        $bid = Bidang::all();
        $transaction = Transaksi::joinToKelas()
            ->joinToBidang()
            ->joinToUser()
            ->joinToModul()
            ->get();
        return view('members.kelas_member', [
            'title' => 'kelas anda',
            'kelas' => $kelas,
            'modul' => $modul,
            'quis' => $quis,
            'bidang' => $bid,
            'transaksi' => $transaction,
            'instansi' => $inst,
        ]);
    }
}
