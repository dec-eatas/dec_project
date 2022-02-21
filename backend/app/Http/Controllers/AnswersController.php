<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Services\FormService;
use App\Services\ListService;
use App\Models\Question;

class AnswersController extends Controller
{
//     public function index()
//     {
//         $answers = Answer::select('aswers.*')
//         ->whereNull('deleted_at')
//         ->orderBy('updated_at', 'DESC')
//         ->get();

// // dd($questions);
//         return view('questions.show', compact('answers'));
//     }

    public function confirm(Request $request)
    {

        $question = $request->only(['question_id','title','content','updated_at','diff']);
        $param = $request->only(['question_id','answer']);
       
        $confirms = FormService::get_confirm($param,['質問id','回答内容'],'01');

        return view('answer.confirm',compact('question','confirms'));

    }

    public function back(Request $request)
    {

        $param = $request->only(['question_id','answer']);
      
        $question = ListService::shape_question(Question::find($param['question_id']));
        $answer = $param['answer'];
        
        return view('questions.show',compact('question','answer'));

    }


    public function store(Request $request)
    {

        $answer = $request->only(['question_id','answer']);

        Answer::insert([
            'user_id' => 1,//auth()->id(),
            'question_id' => $answer['question_id'], // パラメータから取っても良さそう
            'content' =>$answer['answer'],
        ]);

        // question/showを返したいからこうしてるけど、
        return redirect(route('Que.show',['id'=>$answer['question_id']]));

    }
}

