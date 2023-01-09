<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class LembagaController extends Controller
{
    public function GetLembaga()
    {
        $data = Lembaga::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.instansi', [
                'instansi' => $data,
                'title' => 'data instansi'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function AddLembaga(Request $request)
    {
        $validation = $request->validate([
            'nama' => 'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'tentang' => 'required',
            'kontak' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
        ]);
        $logoName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('logo'), $logoName);
        // dd($validation);
        $datas = new Lembaga([
            'nama' => $request->nama,
            'logo' => $logoName,
            'tentang' => $request->tentang,
            'kontak' => $request->kontak,
            'email' => $request->email,
            'whatsapp' => $request->whatsapp,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
        ]);
        $datas->save();
        return redirect('instansi')->with('success', 'data berhasil di tambahkan !');
    }
    public function UpdateById(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'logo' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'tentang' => 'required',
            'kontak' => 'required',
            'email' => 'required',
            'whatsapp' => 'required',
            'facebook' => 'required',
            'instagram' => 'required',
        ]);
        $logoName = time() . '.' . $request->logo->extension();
        $request->logo->move(public_path('logo'), $logoName);
        $edit = array(
            'nama' => $request->post('nama'),
            'logo' => $logoName,
            'tentang' => $request->post('tentang'),
            'kontak' => $request->post('kontak'),
            'email' => $request->post('email'),
            'whatsapp' => $request->post('whatsapp'),
            'facebook' => $request->post('facebook'),
            'instagram' => $request->post('instagram'),
        );
        Lembaga::where('id_lembaga', '=', $request->post('id_lembaga'))->update($edit);
        return redirect('instansi')->with('success', 'data berhasil di edit !');
    }
    public function DeleteById($id)
    {
        Lembaga::where('id_lembaga', '=', $id)->delete();
        return redirect('instansi')->with('success', 'data berhasil di hapus !');
    }
}
