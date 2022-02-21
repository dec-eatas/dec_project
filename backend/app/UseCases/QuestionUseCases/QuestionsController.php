<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use App\Services\ListService;

class QuestionsController extends Controller
{
    // ⬇︎質問一覧画面の表示
    public function index()
    {
        $questions_before = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $questions = ListService::shape_questions($questions_before);

        return view('questions.index', compact('questions'));
    }


    
    //⬇︎質問の作成(view)
    public function create()
    {
        return view('questions.create');
    }



    // 質問をDBに追加(DB)
    public function store(Request $request)
    {
        $question = new Question();

        $question->title = $request->input('title');

        return redirect( route('Que.home'));
    }



    // ⬇︎質問詳細画面の表示
    public function show($id)
    {    
        //インスタンスの作成（$question）
        //compact('question','que_list')
        $question = Question::find($id);
        $que_list = ListService::shape_question($question);
        
        // $answers  = Answer::get_que_answers($id);
        $answers  = ListService::shape_answers(Answer::get_que_answers($id));
        $answer = '';
        return view('questions.show',compact('question','que_list','answers','answer'));
    }
    
    public function edit($id)
    {

        $questions = Question::select('questions.*')
        ->whereNull('deleted_at')
        ->orderBy('updated_at', 'DESC')
        ->get();

        $edit_question = Question::find($id);

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

        Question::where('id',$posts['question_id'])->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('Que.home'));

    }

}