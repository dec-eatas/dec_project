<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Services\FormService;
use App\Services\ListService;
use App\Models\Question;

class AnswersController extends Controller
{

    public function confirm(Request $request)
    {

        $que_list = $request->only(['question_id','title','content','updated_at','diff']);
        $param = $request->only(['question_id','answer']);
        $question = Question::find($param['question_id']);
        $que_list = ListService::shape_question($question);

        $confirms = FormService::get_confirm($param,['質問id','回答内容'],'01');

        return view('answer.confirm',compact('question','confirms','que_list'));

    }

    public function back(Request $request)
    {

        $param = $request->only(['question_id','answer']);
        $question = Question::find($param['question_id']);
        $que_list = ListService::shape_question($question);
        $answers  = ListService::shape_answers(Answer::get_que_answers($param['question_id']));
        $answer = $param['answer'];
        
        return view('questions.show',compact('question','que_list','answer','answers'));

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

