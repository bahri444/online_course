<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Lembaga;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BidangController extends Controller
{
    public function GetAllBidang()
    {
        $data = Lembaga::all();
        $bidang = Bidang::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.bidang', [
                'instansi' => $data,
                'bidang' => $bidang,
                'title' => 'data bidang'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function AddBidang(Request $request)
    {
        $validasi = $request->validate([
            'nama_bidang' => 'required'
        ]);
        if ($validasi == true) {
            $add = new Bidang([
                'nama_bidang' => $request->nama_bidang
            ]);
            $add->save();
            return redirect('bidang')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdateByIdBidang(Request $request)
    {
        $update = array(
            'nama_bidang' => $request->post('nama_bidang')
        );
        Bidang::where('id_bidang', '=', $request->post('id_bidang'))->update($update);
        return redirect('bidang')->with('success', 'data berhasil di edit !');
    }
    public function DeleteByIdBidang($id)
    {
        Bidang::where('id_bidang', '=', $id)->delete();
        return redirect('bidang')->with('success', 'data berhasil di hapus !');
    }
}
