<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function GetAllUser()
    {

        $data = Lembaga::all();
        $dataUser = User::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.user', [
                'instansi' => $data,
                'users' => $dataUser,
                'title' => 'data all user'
            ]);
        } else {
            print('akses di tolak');
        }
    }
    public function GetRegister()
    {
        $data = Lembaga::all();
        return view('auth.register', [
            'lembaga' => $data,
            'title' => 'register'
        ]);
    }
    public function CreateAkun(Request $request)
    {
        $validation = $request->validate([
            'nama_lengkap' => 'required|max:30',
            'email' => 'required|email|unique:user',
            'password' => 'required|min:6',
            // 'role' => 'required'
        ]);
        // dd($validation);
        $user = new User([
            'nama_lengkap' => $request->nama_lengkap,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'role' => $request->role,
        ]);
        $user->save();
        return redirect('login')->with('success', 'proses registrasi telah berhasil silahkan anda login!');
    }
    public function login()
    {
        $data = Lembaga::all();
        return view('auth.login', [
            'lembaga' => $data,
            'title' => 'halaman login'
        ]);
    }
    public function LoginAuth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt($request->only("email", "password"))) {
            if (Auth::user()->role == 'admin') {
                return redirect()->route("dashboard");
            } elseif (Auth::user()->role == 'mentor') {
                return redirect()->route("dashboard");
            } elseif (Auth::user()->role == 'member') {
                return redirect()->route("dashboard");
            } else {
                print('anda tidak memiliki akun');
            }
        }

        return back()->withErrors([
            'password' => 'Wrong email or password',
        ]);
    }
    public function UpdateByIdUser(Request $request)
    {
        $validation = $request->validate([
            'role' => 'required'
        ]);
        // dd($validation);
        if ($validation == true) {
            $edit = array(
                'role' => $request->post('role')
            );
            User::where('id_user', '=', $request->post('id_user'))->update($edit);
            return redirect('user')->with('success', 'data berhasil di edit !');
        }
    }
    public function DeleteByIdUser($id)
    {
        User::where('id_user', '=', $id)->delete();
        return redirect('user')->with('success', 'data berhasil di hapus !');
    }
    public function Logout()
    {
        Session::flush();
        Auth::logout();

        return redirect('/');
    }
    public function AddMember(Request $request)
    {
        $validation = $request->validate([
            'id_user' => 'required',
            'nama_lengkap' => 'required',
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
            $data = new User([
                'id_user' => $request->id_user,
                'nama_lengkap' => $request->nama_lengkap,
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
            'nama_lengkap' => 'required',
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
            'nama_lengkap' => $request->post('nama_lengkap'),
            'tgl_lhr' => $request->post('tgl_lhr'),
            'foto' => $imageName,
            'gender' => $request->post('gender'),
            'alamat' => $request->post('alamat'),
            'github' => $request->post('github'),
            'telepon' => $request->post('telepon')
        );
        User::where('id_member', '=', $request->post('id_member'))->update($data);
        return redirect('member')->with('success', 'data berhasil di edit !');
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
        User::where('id_member', '=', $request->post('id_member'))->update($data);
        return redirect('member')->with('success', 'data berhasil di validasi !');
    }
}
