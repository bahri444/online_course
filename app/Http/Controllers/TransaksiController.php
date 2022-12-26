<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Member;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function GetTransaction()
    {
        $member = Member::all();
        $kelas = Kelas::all();
        $inst = Lembaga::all();
        // $bid = Bidang::all();
        $transaction = DB::table('transaksi_kelas')
            ->join('kelas', 'kelas.id_kelas', '=', 'transaksi_kelas.id_kelas')
            ->join('member', 'member.id_member', '=', 'transaksi_kelas.id_member')
            ->join('bidang', 'bidang.id_bidang', '=', 'kelas.id_bidang')
            ->get();
        return view('admin.transactionKelas', [
            'title' => 'data transaksi',
            'transaksi' => $transaction,
            'member' => $member,
            'kelas' => $kelas,
            'instansi' => $inst,
            // 'instansi' => $inst
        ]);
    }
    // public function AddTransaksi(Request $request)
    // {
    //     $validation = $request->validate([
    //         'id_member' => 'required',
    //         'id_kelas' => 'required',
    //         'tgl_bayar' => 'required',
    //         'validasi_pembayaran' => 'required',
    //     ]);
    //     if ($validation == true) {
    //         $add = new Transaksi([
    //             'id_member' => $request->id_member,
    //             'id_kelas' => $request->id_kelas,
    //             'tgl_bayar' => $request->tgl_bayar,
    //             'validasi_pembayaran' => $request->validasi_pembayaran,
    //         ]);
    //         $add->save();
    //         return redirect('')->with('success', 'pembelian kelas berhasil !');
    //     }
    // }
    public function UpdtTransaksi(Request $request)
    {
        $validation = $request->validate([
            'id_member' => 'required',
            'id_kelas' => 'required',
            'tgl_bayar' => 'required',
            'validasi_pembayaran' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $data = array(
                'id_member' => $request->post('id_member'),
                'id_kelas' => $request->post('id_kelas'),
                'tgl_bayar' => $request->post('tgl_bayar'),
                'validasi_pembayaran' => $request->post('validasi_pembayaran')
            );
            Transaksi::where('id_transaksi', '=', $request->post('id_transaksi'))->update($data);
            return redirect('transactionKelas')->with('success', 'data transaksi berhasil di validasi');
        }
    }
    public function DeleteTransaksi($id)
    {
        Transaksi::where('id_transaksi', '=', $id)->delete();
        return redirect('transactionKelas')->with('data transaksi berhasil di hapus');
    }
}
