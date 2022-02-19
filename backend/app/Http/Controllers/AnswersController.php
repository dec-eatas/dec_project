<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {
        $answer = $request->all();

        $question_id = $answer['question_id'];


        Answer::insert([
            'user_id' => auth()->id(),
            'question_id' => $answer['question_id'], // パラメータから取っても良さそう
            'content' =>$answer['content'],
        ]);

        $answers = Answer::select('answers.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        // question/showを返したいからこうしてるけど、
        return redirect( route('Que.show'));

    }
}

