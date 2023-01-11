<?php

namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Kegiatan;
use App\Models\Kelas;
use App\Models\Lembaga;
use App\Models\Member;
use App\Models\Mentor;

class HomeController extends Controller
{
    public function index()
    {
        $keg = Kegiatan::orderBy('id_kegiatan', 'desc')->limit(5)->get();
        $data = Lembaga::all();
        return view('home.index', [
            'lembaga' => $data,
            'kegiatan' => $keg,
            'title' => 'index'
        ]);
    }
    public function blog()
    {
        $kelas3 = Kelas::where('jenis_kelas', '=', 'bootcamp')->count();
        $kelas2 = Kelas::where('jenis_kelas', '=', 'free')->count();
        $kelas1 = Kelas::where('jenis_kelas', '=', 'premium')->count();
        $mbr = Member::where('status_member', '=', 'aktif')->count();
        $mtrnon = Mentor::where('status_mentor', '=', 'aktif')->count();
        $data = Lembaga::all();
        return view('home.blog', [
            'lembaga' => $data,
            'kegiatan' => $kelas1,
            'member' => $mbr,
            'mentornon' => $mtrnon,
            'kelas1' => $kelas1,
            'kelas2' => $kelas2,
            'kelas3' => $kelas3,
            'title' => 'blog'
        ]);
    }
    public function course()
    {
        $mbr = Member::all()->count();
        $bid = Bidang::all()->count();
        $keg = Kegiatan::all()->count();
        $data = Lembaga::all();
        return view('home.course', [
            'lembaga' => $data,
            'kegiatan' => $keg,
            'member' => $mbr,
            'bidang' => $bid,
            'title' => 'kursus'
        ]);
    }
    public function kontak()
    {
        $data = Lembaga::all();
        return view('home.kontak', [
            'lembaga' => $data,
            'title' => 'kontak'
        ]);
    }
    public function about()
    {
        $data = Lembaga::all();
        return view('home.about', [
            'lembaga' => $data,
            'title' => 'tentang kursus'
        ]);
    }
}
