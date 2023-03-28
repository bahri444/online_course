<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Lembaga;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RolleMentorController extends Controller
{
    public function GetProfile()
    {
        $data = Lembaga::all();
        $dataUser = User::all();
        $dataBidang = Bidang::all();
        $dataMentor = DB::table('bidang')
            ->join('user', 'user.id_bidang', '=', 'bidang.id_bidang')
            ->get();
        if (Auth::user()->role == 'mentor') {
            return view('mentors.profile', [
                'instansi' => $data,
                'users' => $dataUser,
                'bidang' => $dataBidang,
                'mentor' => $dataMentor,
                'title' => 'data mentor'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function LengkapiPP()
    {
        $data = Lembaga::all();
        $dataUser = User::all();
        $dataBidang = Bidang::all();
        $dataMentor = DB::table('bidang')
            ->join('user', 'user.id_bidang', '=', 'bidang.id_bidang')
            ->get();
        if (Auth::user()->role == 'mentor') {
            return view('mentors.lengkapipp', [
                'instansi' => $data,
                'users' => $dataUser,
                'bidang' => $dataBidang,
                'mentor' => $dataMentor,
                'title' => 'data mentor'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function AddPP(Request $request)
    {
        $validation = $request->validate([
            'id_user' => 'required',
            'id_bidang' => 'required',
            'tgl_lhr' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'gender' => 'required',
            'alamat' => 'required',
            'github' => 'required',
            'telepon' => 'required'
        ]);
        // dd($validation);
        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('foto'), $imageName);

        if ($validation == true) {
            $update = array(
                'id_user' => $request->id_user,
                'id_bidang' => $request->id_bidang,
                'tgl_lhr' => $request->tgl_lhr,
                'foto' => $imageName,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'github' => $request->github,
                'telepon' => $request->telepon
            );
            User::where('id_user', '=', $request->id_user)->update($update);
            return redirect('profile')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdtPP(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_bidang' => 'required',
            'tgl_lhr' => 'required',
            'foto' => 'required|image|mimes:png,jpg,jpeg|max:1024',
            'gender' => 'required',
            'alamat' => 'required',
            'github' => 'required',
            'telepon' => 'required'
        ]);
        $imageName = time() . '.' . $request->foto->extension();
        $request->foto->move(public_path('foto'), $imageName);

        $data = array(
            'id_user' => $request->post('id_user'),
            'id_bidang' => $request->post('id_bidang'),
            'tgl_lhr' => $request->post('tgl_lhr'),
            'foto' => $imageName,
            'gender' => $request->post('gender'),
            'alamat' => $request->post('alamat'),
            'github' => $request->post('github'),
            'telepon' => $request->post('telepon')
        );
        User::where('id_user', '=', $request->post('id_user'))->update($data);
        return redirect('profile')->with('success', 'data berhasil di edit !');
    }
}
