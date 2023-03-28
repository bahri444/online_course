<?php

namespace App\Http\Controllers;

use App\Models\Lembaga;
use App\Models\Mentor;
use App\Models\Modul;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function GetQuestion()
    {
        $l = Lembaga::all();
        $mdl = Modul::all();
        $mentor = User::all();
        $question = Question::joinToModul()
            ->joinToKelas()
            ->orderBy('id_question', 'desc')->get();
        if (Auth::user()->role == 'admin') {
            return view('admin.question', [
                'instansi' => $l,
                'mdl' => $mdl,
                'quis' => $question,
                'title' => 'data question'
            ]);
        } elseif (Auth::user()->role == "mentor") {
            // dd($question);
            return view('mentors.question', [
                'instansi' => $l,
                'mdl' => $mdl,
                'quis' => $question,
                'mtr' => $mentor,
                'title' => 'data question'
            ]);
        }
    }
    public function AddQuestion(Request $request)
    {
        $validation = $request->validate([
            'id_modul' => 'required',
            'one' => 'required',
            'two' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $add = new Question([
                'id_modul' => $request->id_modul,
                'one' => $request->one,
                'two' => $request->two,
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
            'status_question' => 'required',
        ]);
        // dd($validation);
        if ($validation == true) {
            $updt = array(
                'id_modul' => $request->post('id_modul'),
                'one' => $request->post('one'),
                'two' => $request->post('two'),
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
