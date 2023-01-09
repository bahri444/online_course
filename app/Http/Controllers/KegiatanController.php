<?php

namespace App\Http\Controllers;

use App\Models\KategoriKegiatan;
use App\Models\Kegiatan;
use App\Models\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KegiatanController extends Controller
{
    public function GetKegiatan()
    {
        $kategori = KategoriKegiatan::all();
        $lembaga = Lembaga::all();
        $kegiatan = DB::table('kegiatan')->join('kategori_kegiatan', 'kategori_kegiatan.id_kategori_keg', '=', 'kegiatan.id_kategori_keg')->get();
        return view('admin.kegiatan', [
            'title' => 'data kegiatan',
            'instansi' => $lembaga,
            'activity' => $kegiatan,
            'kategori_keg' => $kategori,
        ]);
    }
    public function AddKegiatan(Request $request)
    {
        $validation = $request->validate([
            'id_kategori_keg' => 'required',
            'nama_kegiatan' => 'required',
            'foto_keg' => 'required|image|mimes:png,jpg,jpeg|max:3500',
            'deskripsi' => 'required',
            'tujuan' => 'required',
            'manfaat' => 'required',
            'dari' => 'required',
            'sampai' => 'required',
        ]);
        $imageName = time() . '.' . $request->foto_keg->extension();
        // Public Folder
        $request->foto_keg->move(public_path('foto_kegiatan'), $imageName);

        // dd($validation);
        if ($validation == true) {
            $data = new Kegiatan([
                'id_kategori_keg' => $request->id_kategori_keg,
                'nama_kegiatan' => $request->nama_kegiatan,
                'foto_keg' => $imageName,
                'deskripsi' => $request->deskripsi,
                'tujuan' => $request->tujuan,
                'manfaat' => $request->manfaat,
                'dari' => $request->dari,
                'sampai' => $request->sampai,
            ]);
            $data->save();
            return redirect('kegiatan')->with('success', 'data berhasil di tambahkan');
        }
    }
    public function UpdtKegiatan(Request $request)
    {
        $validation = $request->validate([
            'id_kategori_keg' => 'required',
            'nama_kegiatan' => 'required',
            'foto_keg' => 'required|image|mimes:png,jpg,jpeg|max:3500',
            'deskripsi' => 'required',
            'tujuan' => 'required',
            'manfaat' => 'required',
            'dari' => 'required',
            'sampai' => 'required',
        ]);
        $imageName = time() . '.' . $request->foto_keg->extension();
        // Public Folder
        $request->foto_keg->move(public_path('foto_kegiatan'), $imageName);

        // dd($validation);
        if ($validation == true) {
            $data = array(
                'id_kategori_keg' => $request->post('id_kategori_keg'),
                'nama_kegiatan' => $request->post('nama_kegiatan'),
                'foto_keg' => $imageName,
                'deskripsi' => $request->post('deskripsi'),
                'tujuan' => $request->post('tujuan'),
                'manfaat' => $request->post('manfaat'),
                'dari' => $request->post('dari'),
                'sampai' => $request->post('sampai'),
            );
            Kegiatan::where('id_kegiatan', '=', $request->post('id_kegiatan'))->update($data);
            return redirect('kegiatan')->with('success', 'data berhasil di update');
        }
    }
    public function DeleteKegiatan($id)
    {
        Kegiatan::where('id_kegiatan', '=', $id)->delete();
        return redirect('kegiatan')->with('success', 'data berhasil di hapus');
    }
}
