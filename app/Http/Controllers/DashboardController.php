<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function GetAll()
    {
        $mbr = Member::all();
        $data = Lembaga::all();
        if (Auth::user()->role == 'admin') {
            return view('admin.dashboard', [
                'title' => 'Dashboard',
                'instansi' => $data
            ]);
        } elseif (Auth::user()->role == 'mentor') {
            return view('mentors.dashboard', [
                'title' => 'Dashboard',
                'instansi' => $data
            ]);
        } elseif (Auth::user()->role == 'member') {
            return view('members.dashboard', [
                'title' => 'Dashboard',
                'instansi' => $data,
                'member' => $mbr
            ]);
        } else {
            print('akses di tolak');
        }
    }
}
