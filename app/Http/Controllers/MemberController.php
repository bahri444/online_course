<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    public function GetAllMember()
    {
        $data = Lembaga::all();
        $dataUser = User::all();
        $dataMember = DB::table('member')->join('user', 'user.id_user', '=', 'member.id_user')->get();
        if (Auth::user()->role == 'admin') {
            return view('admin.member', [
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
        // Public Folder
        $request->foto->move(public_path('foto'), $imageName);

        if ($validation == true) {
            $data = new Member([
                'id_user' => $request->id_user,
                'nama_member' => $request->nama_member,
                'tgl_lhr' => $request->tgl_lhr,
                'foto' => $imageName,
                'gender' => $request->gender,
                'alamat' => $request->alamat,
                'github' => $request->github,
                'telepon' => $request->telepon
            ]);
            $data->save();
            return redirect('member')->with('success', 'data berhasil di tambahkan !');
        }
    }
    public function UpdateMemberById(Request $request)
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
        // dd($data);
        $imageName = time() . '.' . $request->foto->extension();
        // Public Folder
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
        return redirect('member')->with('success', 'data berhasil di edit !');
    }
    public function DeleteMemberById($id)
    {
        Member::where('id_member', $id)->delete();
        return redirect('member')->with('success', 'data berhasil di hapus !');
    }

    public function ValidMember(Request $request)
    {
        $data = $request->validate([
            'id_user' => 'required',
            'status_member' => 'required'
        ]);
        // dd($data);
        $data = array(
            'id_user' => $request->post('id_user'),
            'status_member' => $request->post('status_member'),
        );
        Member::where('id_member', '=', $request->post('id_member'))->update($data);
        return redirect('member')->with('success', 'data berhasil di validasi !');
    }
}
