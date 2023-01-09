<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatan;
use App\Models\Lembaga;
use Illuminate\Http\Request;

class KategoriKegiatanController extends Controller
{
    public function GetKategoriKeg()
    {
        $lembaga = Lembaga::all();
        $kategoriKeg = KategoriKegiatan::all();
        // dd($kategoriKeg);
        return view('admin.kategoriKegiatan', [
            'kategori_keg' => $kategoriKeg,
            'instansi' => $lembaga,
            'title' => 'kategori kegiatan',
        ]);
    }
    public function AddKategoriKeg(Request $request)
    {
        $validation = $request->validate([
            'nama_kategori' => 'required',
        ]);
        if ($validation == true) {
            $data = new KategoriKegiatan([
                'id_kategori_keg' => $request->id_kategori_keg,
                'nama_kategori' => $request->nama_kategori,
            ]);
            $data->save();
            return redirect('kategoriKegiatan')->with('success', 'data kategori kegitan berhasil di simpan');
        }
    }
    public function UpdtKategoriKeg(Request $request)
    {
        $validation = $request->validate([
            'nama_kategori' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $data = array(
                'nama_kategori' => $request->nama_kategori,
            );
            KategoriKegiatan::where('id_kategori_keg', '=', $request->post('id_kategori_keg'))->update($data);
            return redirect('kategoriKegiatan')->with('success', 'data kategori kegitan berhasil di edit');
        }
    }
    public function DeleteKategoriKeg($id)
    {
        KategoriKegiatan::where('id_kategori_keg', '=', $id)->delete();
        return redirect('kategoriKegiatan')->with('success', 'data kategori kegitan berhasil di hapus');
    }
}
