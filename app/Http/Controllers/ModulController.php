<?php

namespace App\Http\Controllers;

use App\Models\KategoriModul;
use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Modul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ModulController extends Controller
{
    public function GetAllModul()
    {
        $data = Lembaga::all();
        $dataKelas = Kelas::all();
        $dataKategori = KategoriModul::all();
        $join = DB::table('modul')
            ->join('kategori_modul', 'kategori_modul.id_kategori_modul', '=', 'modul.id_kategori_modul')
            ->join('kelas', 'kelas.id_kelas', '=', 'modul.id_kelas')
            ->get();

        if (Auth::user()->role == 'admin') {
            return view('admin.modul', [
                'instansi' => $data,
                'kelas' => $dataKelas,
                'kategori' => $dataKategori,
                'joinTbl' => $join,
                'title' => 'data modul',
            ]);
        } elseif (Auth::user()->role == 'mentor') {
            return view('admin.modul', [
                'instansi' => $data,
                'kelas' => $dataKelas,
                'kategori' => $dataKategori,
                'joinTbl' => $join,
                'title' => 'data modul',
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function AddModul(Request $request)
    {
        $validasi = $request->validate([
            'id_kategori_modul' => 'required',
            'id_kelas' => 'required',
            'judul' => 'required',
            'materi' => 'required',
            'modul_ke' => 'required',
            'tgl_terbit' => 'required',
            'penulis' => 'required',
            // 'status_bel' => 'required',
        ]);
        if ($validasi == true) {
            $add = new Modul([
                'id_kategori_modul' => $request->id_kategori_modul,
                'id_kelas' => $request->id_kelas,
                'judul' => $request->judul,
                'materi' => $request->materi,
                'modul_ke' => $request->modul_ke,
                'tgl_terbit' => $request->tgl_terbit,
                'penulis' => $request->penulis,
                // 'status_bel' => $request->status_bel,
            ]);
            $add->save();
            return redirect('modul')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdateModulById(Request $request)
    {
        $validation = $request->validate([
            'id_kategori_modul' => 'required',
            'id_kelas' => 'required',
            'judul' => 'required',
            'materi' => 'required',
            'modul_ke' => 'required',
            'tgl_terbit' => 'required',
            'penulis' => 'required',
            'status_bel' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $edit = array(
                'id_kategori_modul' => $request->post('id_kategori_modul'),
                'id_kelas' => $request->post('id_kelas'),
                'judul' => $request->post('judul'),
                'materi' => $request->post('materi'),
                'modul_ke' => $request->post('modul_ke'),
                'tgl_terbit' => $request->post('tgl_terbit'),
                'penulis' => $request->post('penulis'),
                'status_bel' => $request->post('status_bel')
            );
            Modul::where('id_modul', '=', $request->post('id_modul'))->update($edit);
            return redirect('modul')->with('success', 'data berhasil di edit !');
        }
    }
    public function DeleteModulById($id)
    {
        Modul::where('id_modul', $id)->delete();
        return redirect('modul')->with('success', 'data berhasil di hapus !');
    }
}
