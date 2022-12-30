<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Lembaga;
use App\Models\Modul;
use App\Models\Question;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    public function GetAnswer()
    {
        $l = Lembaga::all();
        $mdl = Modul::all();
        $quis = Question::all();
        $answer = DB::table('answer')
            ->join('question', 'question.id_question', '=', 'answer.id_question')
            ->join('modul', 'modul.id_modul', '=', 'question.id_modul')
            ->join('kelas', 'kelas.id_kelas', '=', 'modul.id_kelas')
            ->join('transaksi_kelas', 'transaksi_kelas.id_kelas', '=', 'kelas.id_kelas')
            ->join('member', 'member.id_member', '=', 'transaksi_kelas.id_member')
            ->join('bidang', 'bidang.id_bidang', '=', 'kelas.id_bidang')
            ->orderByDesc('id_answer')->get();
        // dd($answer);
        return view('admin.answer', [
            'instansi' => $l,
            'modul' => $mdl,
            'quis' => $quis,
            'answer' => $answer,
            'title' => 'data question'
        ]);
    }
    public function AddAnswer(Request $request)
    {
        $validation = $request->validate([
            'id_question' => 'required',
            'a_one' => 'required',
            'a_two' => 'required',
            'a_three' => 'required',
            'a_four' => 'required',
            'a_five' => 'required',
            'a_six' => 'required',
            'a_seven' => 'required',
            'a_eight' => 'required',
            'a_nine' => 'required',
            'a_ten' => 'required',
            'status_answer' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $add = new Answer([
                'id_question' => $request->id_question,
                'a_one' => $request->a_one,
                'a_two' => $request->a_two,
                'a_three' => $request->a_three,
                'a_four' => $request->a_four,
                'a_five' => $request->a_five,
                'a_six' => $request->a_six,
                'a_seven' => $request->a_seven,
                'a_eight' => $request->a_eight,
                'a_nine' => $request->a_nine,
                'a_ten' => $request->a_ten,
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
