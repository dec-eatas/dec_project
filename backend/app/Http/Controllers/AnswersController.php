<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
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

        $question_id = Question::find($id);


        Answer::insert([
            'user_id' => auth()->id(),
            'question_id' => $question_id['id'], // パラメータから取っても良さそう
            'content' =>$answer['content'],
        ])

        $answers = Answer::select('aswers.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        // compact('questions')
        // return redirect()->route('Que.show', compact('answers',  );
        return redirect( route('Ans.show'));

    }
}

    // // 質問をDBに追加(DB)
    // public function store(Request $request)
    // {
    //     $question = $request->all();
    //     // dd(\Auth::id());//🟡[error]DBに入れる質問を作成したユーザー（ログインしているユーザ）のidを取得したいがエラー 🟡 レンレンが使ってるAuth::user()も同じことかな？ -> こっちのメソッドはユーザー名を取得か
    //     // dd(auth()->id());// [knowledge sharing]こっちだとログインしてるuser_idを取れる。ログインしてないとNull。
    //     // dd($question);
    //     // ⬇︎[needs modifing]DBに格納される値に’’が入ってしまうので、ここの配列に代入してる値修正した方いい。＝＞
    //     Question::insert([
    //         'title' => $question['title'],
    //         'content' =>$question['content'],
    //         'user_id' => auth()->id()
    //     ]);
    //     // 🟡[needs update] 質問を作成した後なので,投稿詳細画面に飛ぶようにする
    //     return redirect( route('Que.create'));
    // }