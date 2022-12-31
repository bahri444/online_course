<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RoleMembersController extends Controller
{

    public function GetProfile()
    {
        $data = Lembaga::all();
        $dataUser = User::all();
        $dataMember = DB::table('member')->join('user', 'user.id_user', '=', 'member.id_user')->get();
        if (Auth::user()->role == 'member') {
            return view('members.profilemember', [
                'instansi' => $data,
                'users' => $dataUser,
                'member' => $dataMember,
                'title' => 'data member'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function LengkapiMember()
    {
        $data = Lembaga::all();
        $dataUser = User::all();
        $dataMember = DB::table('member')->join('user', 'user.id_user', '=', 'member.id_user')->get();
        // dd($dataMember);
        if (Auth::user()->role == 'member') {
            return view('members.lengkapimember', [
                'instansi' => $data,
                'users' => $dataUser,
                'member' => $dataMember,
                'title' => 'data member'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function AddMember(Request $request)
    {
        $validation = $request->validate([
            'id_user' => 'required',
            'nama_member' => 'required',
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
            $add = new Member([
                'id_user' => $request->id_user,
                'nama_member' => $request->nama_member,
                'tgl_lhr' => $request->tgl_lhr,
                'foto' => $imageName,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'github' => $request->github,
                'telepon' => $request->telepon
            ]);
            $add->save();
            return redirect('profilemember')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdtMember(Request $request)
    {
        $request->validate([
            'id_user' => 'required',
            'nama_member' => 'required',
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
            'nama_member' => $request->post('nama_member'),
            'tgl_lhr' => $request->post('tgl_lhr'),
            'foto' => $imageName,
            'gender' => $request->post('gender'),
            'alamat' => $request->post('alamat'),
            'github' => $request->post('github'),
            'telepon' => $request->post('telepon')
        );
        Member::where('id_member', '=', $request->post('id_member'))->update($data);
        return redirect('profilemember')->with('success', 'data berhasil di edit !');
    }
}
