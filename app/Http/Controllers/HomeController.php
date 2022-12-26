<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data = Lembaga::all();
        return view('home.index', [
            'lembaga' => $data,
            'title' => 'index'
        ]);
    }
    public function blog()
    {
        $data = Lembaga::all();
        return view('home.blog', [
            'lembaga' => $data,
            'title' => 'blog'
        ]);
    }
    public function course()
    {
        $data = Lembaga::all();
        return view('home.course', [
            'lembaga' => $data,
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
