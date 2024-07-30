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
            $answers = DB::table('answers')->where('users_id', $user_id)->where('pos_id', $pos->id)->get();
            if(count($answers) == 0){
                $msg = "GET";
                $res = Question::where('pos_id', $pos->id)->get('question');
                foreach ($res as $value) {
                    array_push($questions, $value->question);
                }
                $name = $pos->name;
            }else{
                $msg = "INVALID";
            }

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
        $pass = $request->pass;
        $answers = $request->answers;
        $answers = $request->get('questions');

        foreach ($answers as $key => $answer){
            $userAnswer = new UserAnswer();
            $userAnswer->users_id = $user->id;
            $userAnswer->question_id = $answer['question_id'];
            $userAnswer->pos_id = $request->get('posId');
            $userAnswer->options_id = $answer
        }

        return redirect()->route('dashboard')->with('success', 'Congratulations, you have finished ' . $pos->name);
    }


    function rekap2() {
        $groups = User::where('role','Student')->orderBy('group')->distinct()->get('group');

        // $ans = User::with('answers')->get();
        // dd($ans[2]->answers[1]->pivot->answer);
        // dd($ans);
        // $students = User::first();
        // $pos = Pos::where("password","AAAAA")->question()->first();
        // $answers = $students[0]->answers()->get();
        // dd($answers[3]->pivot->answer);
        return view('rekap2', compact('groups'));
    }

    function changeGroup(Request $request) {
        $group = $request->group;
        $students = User::where('role','Student')->where('group',$group)->get();

        return response()->json(array(
            'students' => $students
        ), 200);
    }

    function changeStudent(Request $request) {
        $student_id = $request->student_id;
        $answers = DB::table('answers')->where('user_id', $student_id)->orderBy('question_id')->get();

        return response()->json(array(
            'answers' => $answers
        ), 200);
    }
}
