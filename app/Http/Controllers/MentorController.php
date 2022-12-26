<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Lembaga;
use App\Models\Mentor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MentorController extends Controller
{
    public function GetAllMentor()
    {
        $data = Lembaga::all();
        $dataUser = User::all();
        $dataBidang = Bidang::all();
        $dataMentor = DB::table('mentor')->join('user', 'user.id_user', '=', 'mentor.id_user')
            ->join('bidang', 'bidang.id_bidang', '=', 'mentor.id_bidang')
            ->get();
        if (Auth::user()->role == 'admin') {
            return view('admin.mentor', [
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
    public function AddMentor(Request $request)
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
            return redirect('mentor')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdateMentorById(Request $request)
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
        return redirect('mentor')->with('success', 'data berhasil di edit !');
    }
    public function DeleteMentorById($id)
    {
        Mentor::where('id_mentor', '=', $id)->delete();
        return redirect('mentor')->with('success', 'data berhasil di hapus !');
    }
}
