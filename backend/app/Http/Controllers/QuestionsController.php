<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    // ⬇︎質問一覧画面の表示
    public function index()
    {
        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
// dd($questions);
        return view('questions.index', compact('questions'));
    }
    
    
    // ⬇︎質問詳細画面の表示
    public function show($id)
    {
        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();
        // dd($id);
        // dd($questions);

        $show_question = Question::find($id);
        // dd($show_question);


        $answers = Answer::select('answers.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('questions.show',compact('show_question' , 'answers'));

    }
    

    //⬇︎質問の作成(view)
    public function create()
    {
        return view('questions.create');
    }



    // 質問をDBに追加(DB)
    public function store(Request $request)
    {
        $question = $request->all();
        // dd(\Auth::id());//🟡[error]DBに入れる質問を作成したユーザー（ログインしているユーザ）のidを取得したいがエラー 🟡 レンレンが使ってるAuth::user()も同じことかな？ -> こっちのメソッドはユーザー名を取得か
        // dd(auth()->id());// [knowledge sharing]こっちだとログインしてるuser_idを取れる。ログインしてないとNull。
        // dd($question);
        // ⬇︎[needs modifing]DBに格納される値に’’が入ってしまうので、ここの配列に代入してる値修正した方いい。＝＞
        Question::insert([
            'title' => $question['title'],
            'content' =>$question['content'],
            'user_id' => auth()->id()
        ]);
        // 🟡[needs update] 質問を作成した後なので,投稿詳細画面に飛ぶようにする
        return redirect( route('Ans.show'));
    }





    // ⬇︎質問の編集(view)(現在一覧画面(index.blade)のタイトルと本文がaタグになっていていてそこから編集に飛ぶ感じになってます)
    // 🟡[needs modifing]あと、この機能は、ログインしてるユーザー本人の質問内容のみ編集できるようにしないとダメ。
    public function edit($id)
    {
        // $question = Question::findOrFail($question_id);
        // ⬇︎一覧表示する時に使う配列です
        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        // ⬇︎編集したい質問内容を編集画面で使うための配列
        $edit_question = Question::find($id);
        // dd($edit_question);

        return view('questions.edit', compact('questions', 'edit_question'));
    }



    // ⬇︎質問を編集した内容をDBに保存(DB)
    public function update(Request $request)
    {
        $posts = $request->all();
        // dd($posts);

        Question::where('id',$posts['question_id'])
            ->update([
                'content' => $posts['content'],
                'title' => $posts['title']
            ]);

        return redirect( route('Que.home'));

    }





    public function destroy(Request $request)
    {

        $posts = $request->all();
        // dd($posts);
        //論理削除
        Question::where('id',$posts['question_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('Que.home'));

    }


    //🟡[needs Reconciling perceptions] ditail()がなんなのかわからない。web.phpに詳細あり。レンレン見てたら確認お願い。

}