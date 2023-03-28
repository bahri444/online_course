<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lembaga;
use App\Models\Mentor;
use App\Models\Modul;
use App\Models\Question;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function GetAnswer()
    {
        $l = Lembaga::all();
        $mdl = Modul::all();
        $quis = Question::all();
        $mentor = User::all();
        $answer = Answer::leftJoinToQuestion()
            ->leftJoinToModul()
            ->leftJoinToKelas()
            ->leftJoinToBidang()
            ->orderByDesc('id_answer')->get();
        if (Auth::user()->role == "admin") {
            return view('admin.answer', [
                'instansi' => $l,
                'modul' => $mdl,
                'quis' => $quis,
                'answer' => $answer,
                'title' => 'data question'
            ]);
        } elseif (Auth::user()->role == 'mentor') {
            return view('mentors.answer', [
                'instansi' => $l,
                'modul' => $mdl,
                'quis' => $quis,
                'answer' => $answer,
                'mentor' => $mentor,
                'title' => 'jawaban modul'
            ]);
        }
    }
    public function AddAnswer(Request $request)
    {
        $validation = $request->validate([
            'id_question' => 'required',
            'nama_anda' => 'required',
            'a_one' => 'required',
            'a_two' => 'required',
            'status_answer' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $add = new Answer([
                'id_question' => $request->id_question,
                'nama_anda' => $request->nama_anda,
                'a_one' => $request->a_one,
                'a_two' => $request->a_two,
                'status_answer' => $request->status_answer,
            ]);
            $add->save();
            return redirect('kelas_member')->with('success', 'jawaban berhasil di kirim..!');
        }
    }
    public function UpdtAnswer(Request $request)
    {
        $validation = $request->validate([
            'status_answer' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $updt = array(
                'status_answer' => $request->post('status_answer'),
            );
            Answer::where('id_answer', '=', $request->post('id_answer'))->update($updt);
            return redirect('answer')->with('success', 'data answer berhasil di update...!');
        }
    }
    public function DeleteAnswer($id)
    {
        Answer::where('id_answer', '=', $id)->delete();
        return redirect('answer')->with('success', 'answer berhasil di hapus');
    }
}
