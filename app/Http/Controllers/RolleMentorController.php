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
        $dataMentor = DB::table('mentor')
            ->join('user', 'user.id_user', '=', 'mentor.id_user')
            ->join('bidang', 'bidang.id_bidang', '=', 'mentor.id_bidang')
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
        $dataMentor = DB::table('mentor')->join('user', 'user.id_user', '=', 'mentor.id_user')
            ->join('bidang', 'bidang.id_bidang', '=', 'mentor.id_bidang')
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
            'nama_mentor' => 'required',
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
            $add = new Mentor([
                'id_user' => $request->id_user,
                'id_bidang' => $request->id_bidang,
                'nama_mentor' => $request->nama_mentor,
                'tgl_lhr' => $request->tgl_lhr,
                'foto' => $imageName,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'github' => $request->github,
                'telepon' => $request->telepon
            ]);
            $add->save();
            return redirect('profile')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdtPP(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'id_bidang' => 'required',
            'nama_mentor' => 'required',
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
            'nama_mentor' => $request->post('nama_mentor'),
            'tgl_lhr' => $request->post('tgl_lhr'),
            'foto' => $imageName,
            'gender' => $request->post('gender'),
            'alamat' => $request->post('alamat'),
            'github' => $request->post('github'),
            'telepon' => $request->post('telepon')
        );
        Mentor::where('id_mentor', '=', $request->post('id_mentor'))->update($data);
        return redirect('profile')->with('success', 'data berhasil di edit !');
    }
}
