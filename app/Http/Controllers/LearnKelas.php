<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Bidang;
use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Member;
use App\Models\Modul;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LearnKelas extends Controller
{

    public function ReadKelas()
    {
        $member = Member::all();
        $kelas = Kelas::all();
        $inst = Lembaga::all();
        $kelas = Kelas::all();
        $modul = Modul::all();
        $quis = Question::all();
        $bid = Bidang::all();
        $transaction = DB::table('transaksi_kelas')
            ->join('kelas', 'kelas.id_kelas', '=', 'transaksi_kelas.id_kelas')
            ->join('bidang', 'bidang.id_bidang', '=', 'kelas.id_bidang')
            ->join('member', 'member.id_member', '=', 'transaksi_kelas.id_member')
            ->join('modul', 'modul.id_kelas', '=', 'kelas.id_kelas')
            ->join('question', 'question.id_modul', '=', 'modul.id_modul')
            ->get();
        // dd($transaction);
        return view('members.kelas_member', [
            'title' => 'kelas anda',
            'member' => $member,
            'kelas' => $kelas,
            'modul' => $modul,
            'quis' => $quis,
            'bidang' => $bid,
            'transaksi' => $transaction,
            'instansi' => $inst,
        ]);
    }
}
