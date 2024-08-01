<?php

namespace App\Http\Controllers;

use App\Option;
use App\Pos;
use App\Question;
use App\User;
use App\UserAnswer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Expr\Cast\Object_;

class TourController extends Controller
{
    public function dashboard()
    {
        $user_id = Auth::user()->id;
        $pos = [10];

        $answers = DB::table('user_answers')->where('users_id', $user_id)->orderBy('pos_id','desc')->get();
        foreach ($answers as $value) {
            array_push($pos, $value->pos_id);
        }

        $temp = DB::table('user_answers')->selectRaw('COUNT(question_id), pos_id')->where('users_id', $user_id)->groupBy('pos_id')->get();
        $count = $temp->count();
        $current_pos = Auth::user()->current_pos;
        return view('dashboard', compact('pos', 'count', 'current_pos'));
    }

    function rekap() {
        $students = User::where('role','Student')->orderBy('group')->get();
        $groups = ['--Show All--'];
        foreach ($students as $value) {
            if(!array_search($value->group,$groups)){
                array_push($groups, $value->group);
            }
        }

        // $ans = User::with('answers')->get();
        // dd($ans[2]->answers[1]->pivot->answer);
        // dd($ans);
        // $students = User::first();
        // $pos = Pos::where("password","AAAAA")->question()->first();
        // $answers = $students[0]->answers()->get();
        // dd($answers[3]->pivot->answer);
        return view('rekap', compact('groups','students'));
    }


    function checkPass(Request $request) {
        $pass = $request->pass;
        $user_id = Auth::user()->id;
        $pos = Pos::where("password",$pass)->first();
        $questions = [];
        $name = "";
        if($pos != null){
            $answers = DB::table('user_answers')->where('users_id', $user_id)->where('pos_id', $pos->id)->get();
            if(count($answers) == 0){
                $msg = "GET";
                $cacheDuration = 300;
                $cacheKey = 'question_pos_' . $pos->id;
                $question = Cache::remember($cacheKey, $cacheDuration, function () use ($pos) {
                    return Question::with('option')->where('pos_id', $pos->id)->get();
                    $options=[];
                });

                // Question::with('option')->where('pos_id', 1)->get();
                array_push($questions, $question);
                $name = $pos->name;
            }else{
                $msg = "INVALID";
            }
        }else{
            $msg = "FALSE";
        }

        return response()->json(array(
            'pos' => $name,
            'questions' => $questions,
            'msg' => $msg
        ), 200);
    }

    function showOptions(){

    }
//    function submitAnswers(Request $request){
//        $user = Auth::user();
//        $pass = $request->pass;
//        $answers = $request->answers;
//        $pos = Pos::where("password",$pass)->first();
//        $questions = Question::where('pos_id',$pos->id)->get();
//
//        foreach ($questions as $key => $value) {
//            DB::table('answers')->insert([
//                "user_id" => $user->id,
//                "question_id" => $value->id,
//                "pos_id" => $pos->id,
//                "answer" => $answers[$key]
//            ]);
//        }
//
//        DB::table('users')->where('id', $user->id)->update(['current_pos' => $pos->id]);
//
//        return response()->json(array(
//            'msg' => "Congratulations, you have finished " . $pos->name
//        ), 200);
//    }

    function submitAnswers(Request $request){
        $user = Auth::user();
        $answers = $request->answers;
        $answers = $request->get('question');

        $isAnswerd = UserAnswer::where('users_id', $user->id)->where('pos_id', $request->get('posId'))->get();
        if(count($isAnswerd) > 0){
            return redirect()->route('dashboard')->with('status', 'error')->with('message', 'Anda sudah menjawab soal ini');
        }

        foreach ($answers as $key => $answer){
            $userAnswer = new UserAnswer();
            $userAnswer->users_id = $user->id;
            $userAnswer->question_id = $key;
            $userAnswer->pos_id = $request->get('posId');
            $userAnswer->options_id = $answer['option'];
            $userAnswer->save();
        }

        return redirect()->route('dashboard')->with('status', 'success')->with('message', 'Berhasil menyimpan jawaban');
    }


    function rekap2() {
        $groups = User::where('role','Student')->orderBy('group')->distinct()->get('group');
        $userAnswer = [];
        // $ans = User::with('answers')->get();
        // dd($ans[2]->answers[1]->pivot->answer);
        // dd($ans);
        // $students = User::first();
        // $pos = Pos::where("password","AAAAA")->question()->first();
        // $answers = $students[0]->answers()->get();
        // dd($answers[3]->pivot->answer);

        // FOR ANTON
        // Nanti ini masukkin di changeStudent dan belum ada ubah where buat group sama user nya
        $users = User::where('group', 'TETA 17')->get();
        foreach ($users as $user){
            $answers = UserAnswer::with(['option' => function ($query) {
                $query->where('isCorrect', 1);
            }])->where('users_id', $user->id)->orderBy('pos_id')->get();
            // $tempObject = (object) [
            //     'username' => $user->username,
            //     'pos_id' => $answers[0]->pos_id,
            // ];
            $userAnswer[] = $answers;
        }
//        for($i=1;$i<=7;$i++){
//            $answerPerGedung = DB::table('users')
//                ->join('user_answers', 'user_answers.users_id', '=', 'users.id')
//                ->join('options', 'options.id', '=', 'user_answers.options_id')
//                ->where('users.group', 'TETA 19')
////                ->where('users.id', 3)
//                ->where('user_answers.pos_id', $i)
//                ->where('options.isCorrect', 1)
//                ->select('users.id', 'users.username', 'users.name', 'user_answers.question_id', 'user_answers.pos_id', 'user_answers.options_id', 'options.isCorrect')
//                ->get();
//
//
////            $answerPerGedung = $answerPerGedung->fi
////            $answerPerGedung = UserAnswer::with(['user' => function ($query) {
////                $query->where('group', 'TETA 19');
////            }], 'option')->where('users_id', 3)->where('pos_id',$i)->get();
//            array_push($userAnswer, $answerPerGedung);
//        }


        return view('rekap2', compact('groups','userAnswer'));
    }

    function changeGroup(Request $request) {
        $group = $request->group;

        
        $nilais = DB::table('user_answers as ua')
        ->select(DB::raw('COUNT(o.isCorrect) as nilai'),'u.username as nrp', 'u.name as nama')
        ->join('options as o', 'ua.options_id','=','o.id')
        ->join('users as u','ua.users_id','=','u.id')
        ->where('u.group', $group)->get();

        
        return response()->json(array(
            'nilais' => $nilais
        ), 200);
    }

    //ga kepake
    function changeStudent(Request $request) {
        $student_id = $request->student_id;
//        $answers = DB::table('answers')->where('user_id', $student_id)->orderBy('question_id')->get();

        $userAnswers = UserAnswer::with('option')->get();
        var_dump($userAnswers);


//        return response()->json(array(
//            'answers' => $answers
//        ), 200);
    }
}
