<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Topic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function index()
    {
        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        return view('questions.index', compact('questions'));
    }



    //追加した
    public function create()
    {
        return view('questions.create');
    }



    // 質問を
    public function store(Request $request)
    {

        $question = $request->all();
        dd($question);
        Question::insert([
            'user_id' => \Auth::id(),
            'title' => '\''.$question['title'].'\'',
            'content' =>'\''.$question['content'].'\''
        ]);
    return redirect( route('create'));

    }


    public function edit($id)
    {
        // $question = Question::findOrFail($question_id);
        // ⬇︎一覧表示する時に使う配列です
        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        // 編集したい質問内容を編集画面で使うための配列
        $edit_question = Question::find($id);
        // dd($edit_question);
        

        return view('questions.edit', compact('questions', 'edit_question'));
    }


    
    public function update(Request $request)
    {

        $posts = $request->all();
        // dd($posts);
    
        Question::where('id',$posts['question_id'])->update(['content' => $posts['content']]);
        


        return redirect( route('home'));

    }


    public function show($question_id)
    {
        $question = Question::findOrFail($question_id);

        return view('questions.show',[
            'question' => $question,
        ]);    
    }    



    public function destroy(Request $request)
    {
        $posts = $request->all();
        // dd($posts);
        //論理削除
        Question::where('id',$posts['question_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('home'));

    }

}