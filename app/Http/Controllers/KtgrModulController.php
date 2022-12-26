<?php

namespace App\Http\Controllers;

use App\Models\KategoriModul;
use App\Models\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KtgrModulController extends Controller
{
    public function GetAllKtgrModul()
    {
        $data = Lembaga::all();
        $dataKtgr = KategoriModul::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.ktgrModul', [
                'instansi' => $data,
                'ktgrModul' => $dataKtgr,
                'title' => 'data kategori modul'
            ]);
        } elseif (Auth::user()->role == 'mentor') {
            return view('admin.ktgrModul', [
                'instansi' => $data,
                'ktgrModul' => $dataKtgr,
                'title' => 'data kategori modul'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function AddKtgrModul(Request $request)
    {
        $validasi = $request->validate([
            'jenis_modul' => 'required'
        ]);
        if ($validasi == true) {
            $add = new KategoriModul([
                'jenis_modul' => $request->jenis_modul
            ]);
            $add->save();
            return redirect('ktgrModul')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdateByIdKtgrModul(Request $request)
    {
        $edit = array(
            'jenis_modul' => $request->post('jenis_modul')
        );
        KategoriModul::where('id_kategori_modul', '=', $request->post('id_kategori_modul'))->update($edit);
        return redirect('ktgrModul')->with('success', 'data berhasil di edit !');
    }
    public function DeleteByIdKtgrModul($id)
    {
        KategoriModul::where('id_kategori_modul', '=', $id)->delete();
        return redirect('ktgrModul')->with('success', 'data berhasil di hapus !');
    }
}
