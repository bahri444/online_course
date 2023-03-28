<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Member;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function GetAllKelas()
    {
        $data = Lembaga::all();
        $dataBidang = Bidang::all();
        $dataUser = User::all();
        $transaksi = Transaksi::all();
        $dataKelas = DB::table('kelas')
            ->join('bidang', 'bidang.id_bidang', '=', 'kelas.id_bidang')
            ->get();
        // dd($dataKelas);
        if (Auth::user()->role == 'admin') {
            return view('admin.kelas', [
                'instansi' => $data,
                'data_bidang' => $dataBidang,
                'joinKelas' => $dataKelas,
                'title' => 'data kelas'
            ]);
        } else if (Auth::user()->role == 'member') {
            return view('members.allClass', [
                'instansi' => $data,
                'users' => $dataUser,
                'data_bidang' => $dataBidang,
                'joinKelas' => $dataKelas,
                'transaksi' => $transaksi,
                'title' => 'data kelas'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function AddKelas(Request $request)
    {
        $validation = $request->validate([
            'id_bidang' => 'required',
            'jenis_kelas' => 'required',
            'harga_kelas' => 'required',
            'lama_course' => 'required',
            'tanggal_berakhir' => 'required'
        ]);
        if ($validation == true) {
            $add = new Kelas([
                'id_bidang' => $request->id_bidang,
                'jenis_kelas' => $request->jenis_kelas,
                'harga_kelas' => $request->harga_kelas,
                'lama_course' => $request->lama_course,
                'tanggal_berakhir' => $request->tanggal_berakhir
            ]);
            $add->save();
            return redirect('kelas')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdateKelasById(Request $request)
    {
        $validation = $request->validate([
            'id_bidang' => 'required',
            'jenis_kelas' => 'required',
            'harga_kelas' => 'required',
            'lama_course' => 'required',
            'tanggal_berakhir' => 'required'
        ]);
        // dd($validation);
        if ($validation == true) {
            $data = array(
                'id_bidang' => $request->post('id_bidang'),
                'jenis_kelas' => $request->post('jenis_kelas'),
                'harga_kelas' => $request->post('harga_kelas'),
                'lama_course' => $request->post('lama_course'),
                'tanggal_berakhir' => $request->post('tanggal_berakhir')
            );
            Kelas::where('id_kelas', '=', $request->post('id_kelas'))->update($data);
            return redirect('kelas')->with('success', 'data berhasil di edit !');
        }
    }
    public function DeleteKelasById($id)
    {
        Kelas::where('id_kelas', '=', $id)->delete();
        return redirect('kelas')->with('success', 'data berhasil di hapus !');
    }

    public function AddTransaksi(Request $request)
    {
        $validation = $request->validate([
            'id_member' => 'required',
            'id_kelas' => 'required',
            'tgl_bayar' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $add = new Transaksi([
                'id_member' => $request->id_member,
                'id_kelas' => $request->id_kelas,
                'tgl_bayar' => $request->tgl_bayar,
            ]);
            $add->save();
            return redirect('kelas')->with('success', 'pembelian kelas berhasil !');
        }
    }
}
