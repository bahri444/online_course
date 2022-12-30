<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Modul;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function GetQuestion()
    {
        $l = Lembaga::all();
        $mdl = Modul::all();
        $question = DB::table('question')
            ->join('modul', 'modul.id_modul', '=', 'question.id_modul')
            ->join('kelas', 'kelas.id_kelas', '=', 'modul.id_kelas')
            ->orderBy('id_question', 'desc')->get();
        return view('admin.question', [
            'instansi' => $l,
            'mdl' => $mdl,
            'quis' => $question,
            'title' => 'data question'
        ]);
    }
    public function AddQuestion(Request $request)
    {
        $validation = $request->validate([
            'id_modul' => 'required',
            'one' => 'required',
            'two' => 'required',
            'three' => 'required',
            'four' => 'required',
            'five' => 'required',
            'six' => 'required',
            'seven' => 'required',
            'eight' => 'required',
            'nine' => 'required',
            'ten' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $add = new Question([
                'id_modul' => $request->id_modul,
                'one' => $request->one,
                'two' => $request->two,
                'three' => $request->three,
                'four' => $request->four,
                'five' => $request->five,
                'six' => $request->six,
                'seven' => $request->seven,
                'eight' => $request->eight,
                'nine' => $request->nine,
                'ten' => $request->ten,
            ]);
            $add->save();
            return redirect('question')->with('success', 'soal quis berhasil di tambahkan..!');
        }
    }
    public function UpdtQuestion(Request $request)
    {
        $validation = $request->validate([
            'id_modul' => 'required',
            'one' => 'required',
            'two' => 'required',
            'three' => 'required',
            'four' => 'required',
            'five' => 'required',
            'six' => 'required',
            'seven' => 'required',
            'eight' => 'required',
            'nine' => 'required',
            'ten' => 'required',
            'status_question' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $updt = array(
                'id_modul' => $request->post('id_modul'),
                'one' => $request->post('one'),
                'two' => $request->post('two'),
                'three' => $request->post('three'),
                'four' => $request->post('four'),
                'five' => $request->post('five'),
                'six' => $request->post('six'),
                'seven' => $request->post('seven'),
                'eight' => $request->post('eight'),
                'nine' => $request->post('nine'),
                'ten' => $request->post('ten'),
                'status_question' => $request->post('status_question'),
            );
            Question::where('id_question', '=', $request->post('id_question'))->update($updt);
            return redirect('question')->with('success', 'data question berhasil di update...!');
        }
    }
    public function DeleteQuestion($id)
    {
        Question::where('id_question', '=', $id)->delete();
        return redirect('question')->with('success', 'question berhasil di hapus');
    }
}
